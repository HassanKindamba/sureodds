<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\ChatBan;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    /**
     * ============================================================
     * COMMUNITY CHAT MANAGEMENT
     * ============================================================
     *
     * Manager anaweza:
     *
     * - Kuona messages zote
     * - Kutuma text
     * - Kutuma emoji
     * - Kutuma links
     * - Ku-upload image
     * - Kutuma text + image
     * - Ku-pin message
     * - Ku-unpin message
     * - Kufuta message
     * - Kublock user
     * - Ku-unblock user
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | CHAT MESSAGES
        |--------------------------------------------------------------------------
        */

        $messages = ChatMessage::with('user')
            ->latest()
            ->paginate(50);


        /*
        |--------------------------------------------------------------------------
        | ACTIVE BANNED USERS
        |--------------------------------------------------------------------------
        */

        $bannedUsers = ChatBan::with([
                'user',
                'blockedBy'
            ])
            ->where(function ($query) {

                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());

            })
            ->latest('blocked_at')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.manager.chat.index',
            compact(
                'messages',
                'bannedUsers'
            )
        );
    }


    /**
     * ============================================================
     * STORE / SEND MANAGER CHAT MESSAGE
     * ============================================================
     *
     * Manager ana ruhusa:
     *
     * - Text
     * - Emoji
     * - Links
     * - Images
     * - Text + Image
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CHECK AUTHENTICATION
        |--------------------------------------------------------------------------
        */

        if (!Auth::check()) {

            return back()->with(
                'error',
                'Login required.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | GET CURRENT USER
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        |
        | Route hii ni ya manager.
        | Hata hivyo tuna-check role tena hapa kwa usalama.
        |
        */

        if ($user->role !== 'manager') {

            abort(403, 'Unauthorized action.');
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATE MESSAGE + IMAGE
        |--------------------------------------------------------------------------
        |
        | Message inaweza kuwa empty kama image imetumwa.
        |
        */

        $request->validate([

            'message' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | CLEAN MESSAGE
        |--------------------------------------------------------------------------
        */

        $message = trim(
            (string) $request->input('message')
        );


        /*
        |--------------------------------------------------------------------------
        | CHECK THAT MESSAGE OR IMAGE EXISTS
        |--------------------------------------------------------------------------
        */

        if (
            $message === '' &&
            !$request->hasFile('image')
        ) {

            return back()->with(
                'error',
                'Andika message au upload image.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | IMAGE UPLOAD
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('chat', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | MESSAGE TYPE
        |--------------------------------------------------------------------------
        |
        | Kama image ipo na text ipo:
        | type = text
        |
        | Kama image pekee:
        | type = image
        |
        */

        $type = $imagePath && $message === ''
            ? 'image'
            : 'text';


        /*
        |--------------------------------------------------------------------------
        | CREATE MESSAGE
        |--------------------------------------------------------------------------
        */

        ChatMessage::create([

            'user_id' => $user->id,

            'type' => $type,

            'message' => $message !== ''
                ? $message
                : null,

            'image_path' => $imagePath,

            'is_pinned' => false,

            'pinned_at' => null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Message imetumwa kwenye Community Chat.'
        );
    }


    /**
     * ============================================================
     * PIN MESSAGE
     * ============================================================
     *
     * Mfumo unaruhusu PINNED MESSAGE MOJA TU.
     *
     * Manager anaweza ku-pin:
     *
     * - Message ya user
     * - Message ya manager
     */
    public function pin($id)
    {
        $message = ChatMessage::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | REMOVE OLD PIN
        |--------------------------------------------------------------------------
        */

        ChatMessage::where('is_pinned', true)
            ->where('id', '!=', $message->id)
            ->update([

                'is_pinned' => false,

                'pinned_at' => null,

            ]);


        /*
        |--------------------------------------------------------------------------
        | PIN SELECTED MESSAGE
        |--------------------------------------------------------------------------
        */

        $message->update([

            'is_pinned' => true,

            'pinned_at' => now(),

        ]);


        return back()->with(
            'success',
            'Message imewekwa pinned. Pinned message ya zamani imeondolewa.'
        );
    }


    /**
     * ============================================================
     * UNPIN MESSAGE
     * ============================================================
     */
    public function unpin($id)
    {
        $message = ChatMessage::findOrFail($id);


        $message->update([

            'is_pinned' => false,

            'pinned_at' => null,

        ]);


        return back()->with(
            'success',
            'Message imeondolewa pinned.'
        );
    }


    /**
     * ============================================================
     * DELETE CHAT MESSAGE
     * ============================================================
     */
    public function destroy($id)
    {
        $message = ChatMessage::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | DELETE IMAGE FROM STORAGE
        |--------------------------------------------------------------------------
        */

        if ($message->image_path) {

            Storage::disk('public')
                ->delete($message->image_path);
        }


        /*
        |--------------------------------------------------------------------------
        | DELETE MESSAGE
        |--------------------------------------------------------------------------
        */

        $message->delete();


        return back()->with(
            'success',
            'Chat message imefutwa.'
        );
    }


    /**
     * ============================================================
     * BAN USER
     * ============================================================
     */
    public function ban(Request $request, $userId)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'reason' => [
                'nullable',
                'string',
                'max:255',
            ],

            'duration' => [
                'required',
                'in:10m,1h,1d,7d,permanent',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | FIND USER
        |--------------------------------------------------------------------------
        */

        $user = User::findOrFail($userId);


        /*
        |--------------------------------------------------------------------------
        | MANAGER / DEVELOPER PROTECTION
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $user->role,
                ['manager', 'developer']
            )
        ) {

            return back()->with(
                'error',
                'Manager au Developer hawezi kubanwa kupitia Community Chat.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK EXISTING ACTIVE BAN
        |--------------------------------------------------------------------------
        */

        $existingBan = ChatBan::where(
                'user_id',
                $user->id
            )
            ->where(function ($query) {

                $query->whereNull('expires_at')
                    ->orWhere(
                        'expires_at',
                        '>',
                        now()
                    );

            })
            ->latest()
            ->first();


        if ($existingBan) {

            return back()->with(
                'error',
                "{$user->name} tayari ameblockiwa."
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CALCULATE BAN EXPIRATION
        |--------------------------------------------------------------------------
        */

        $expiresAt = match (
            $request->duration
        ) {

            '10m' =>
                now()->addMinutes(10),

            '1h' =>
                now()->addHour(),

            '1d' =>
                now()->addDay(),

            '7d' =>
                now()->addDays(7),

            'permanent' =>
                null,

        };


        /*
        |--------------------------------------------------------------------------
        | CREATE BAN
        |--------------------------------------------------------------------------
        */

        ChatBan::create([

            'user_id' =>
                $user->id,

            'blocked_by' =>
                Auth::id(),

            'reason' =>
                $request->reason,

            'blocked_at' =>
                now(),

            'expires_at' =>
                $expiresAt,

        ]);


        /*
        |--------------------------------------------------------------------------
        | DURATION TEXT
        |--------------------------------------------------------------------------
        */

        $durationText = match (
            $request->duration
        ) {

            '10m' =>
                'dakika 10',

            '1h' =>
                'saa 1',

            '1d' =>
                'siku 1',

            '7d' =>
                'siku 7',

            'permanent' =>
                'milele',

        };


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            "{$user->name} ameblockiwa kwenye Community Chat kwa {$durationText}."
        );
    }


    /**
     * ============================================================
     * UNBAN USER
     * ============================================================
     */
    public function unban($id)
    {
        $ban = ChatBan::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | EXPIRE BAN
        |--------------------------------------------------------------------------
        |
        | Hatu-delete record.
        | Tunaweka expires_at kuwa sasa.
        |
        */

        $ban->update([

            'expires_at' => now(),

        ]);


        return back()->with(
            'success',
            'User ame-unblockiwa na anaweza kutumia Community Chat tena.'
        );
    }
}