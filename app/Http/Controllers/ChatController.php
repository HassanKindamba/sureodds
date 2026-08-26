<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatBan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * ============================================================
     * SHOW COMMUNITY CHAT
     * ============================================================
     *
     * Frontend:
     * - Guest anaweza kusoma
     * - User aliye-login anaweza kutuma text
     * - Pinned message inaonekana juu
     * - Images zilizotumwa na manager zinaonekana
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | PINNED MESSAGE
        |--------------------------------------------------------------------------
        |
        | Mfumo wetu unaruhusu pinned message moja.
        |
        | Tunachukua message yenye:
        | is_pinned = true
        |
        | latest('pinned_at') inahakikisha ikiwa kuna zaidi ya moja
        | iliyowahi kupin, ya mwisho ndiyo inachukuliwa.
        |
        */

        $pinnedMessage = ChatMessage::with('user')
            ->where('is_pinned', true)
            ->latest('pinned_at')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | CHAT MESSAGES
        |--------------------------------------------------------------------------
        |
        | oldest():
        | Message za zamani zinaanza juu,
        | message mpya zinaenda chini.
        |
        | with('user'):
        | Tunapata taarifa za user bila kufanya query kila message.
        |
        */

        $messages = ChatMessage::with('user')
            ->oldest()
            ->paginate(50);


        /*
        |--------------------------------------------------------------------------
        | SEND DATA TO FRONTEND
        |--------------------------------------------------------------------------
        */

        return view(
            'frontend.chat',
            compact(
                'messages',
                'pinnedMessage'
            )
        );
    }


    /**
     * ============================================================
     * SEND CHAT MESSAGE
     * ============================================================
     *
     * Normal users:
     *
     * - Text ✅
     * - Emoji ✅
     * - Links ❌
     * - Images ❌
     *
     * Manager image upload inafanyika kupitia
     * Manager\ChatController.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | LOGIN CHECK
        |--------------------------------------------------------------------------
        */

        if (!Auth::check()) {

            return back()->with(
                'error',
                'Login required to send messages.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CURRENT USER
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | CHECK ACTIVE CHAT BAN
        |--------------------------------------------------------------------------
        |
        | Ikiwa user ameblockiwa na ban bado haija-expire,
        | haruhusiwi kutuma message.
        |
        */

        $activeBan = ChatBan::where(
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


        if ($activeBan) {

            return back()->with(
                'error',
                'Umezuiwa kutuma ujumbe kwa sasa.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATE MESSAGE
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'message' => [
                'required',
                'string',
                'max:500',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | CLEAN MESSAGE
        |--------------------------------------------------------------------------
        */

        $message = trim(
            $request->input('message')
        );


        /*
        |--------------------------------------------------------------------------
        | EMPTY MESSAGE CHECK
        |--------------------------------------------------------------------------
        */

        if ($message === '') {

            return back()->with(
                'error',
                'Ujumbe hauwezi kuwa mtupu.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | BLOCK LINKS
        |--------------------------------------------------------------------------
        |
        | Normal users hawaruhusiwi kutuma:
        |
        | https://example.com
        | http://example.com
        | www.example.com
        | example.com
        | example.net
        | example.org
        | example.tz
        | example.co.tz
        |
        */

        if ($this->containsLink($message)) {

            return back()->with(
                'error',
                'Kutuma links hakuruhusiwi kwenye chat.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE MESSAGE
        |--------------------------------------------------------------------------
        |
        | User wa kawaida:
        |
        | type       = text
        | message    = text yake
        | image_path = null
        | is_pinned  = false
        | pinned_at  = null
        |
        */

        ChatMessage::create([

            'user_id' => $user->id,

            'type' => 'text',

            'message' => $message,

            'image_path' => null,

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
            'Ujumbe umetumwa.'
        );
    }


    /**
     * ============================================================
     * CHECK MESSAGE FOR LINKS
     * ============================================================
     *
     * Returns true ikiwa message inaonekana kuwa na URL/domain.
     */
    private function containsLink(string $message): bool
    {
        /*
        |----------------------------------------------------------------------
        | URL / DOMAIN PATTERN
        |----------------------------------------------------------------------
        |
        | Tunazuia:
        |
        | http://
        | https://
        | www.
        | .com
        | .net
        | .org
        | .tz
        | .co.tz
        |
        */

        return preg_match(
            '/(?:https?:\/\/|www\.|[a-z0-9-]+\.(?:com|net|org|co\.tz|tz))(?:[^\s]*)/i',
            $message
        ) === 1;
    }
}