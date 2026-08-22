<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\BetSlip;
use App\Models\Prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PredictionsController extends Controller
{

    public function index()
    {
        $betSlips = BetSlip::with('predictions')->latest()->get();

        return view('admin.manager.predictions.index', compact('betSlips'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $betSlip = BetSlip::create([
                'bet_code' => $request->bet_code,
                'bookmaker' => $request->bookmaker,
                'betting_link' => $request->betting_link,
            ]);

            foreach ($request->matches ?? [] as $key => $match) {

                if (!$match) {
                    continue;
                }

                Prediction::create([
                    'bet_slip_id' => $betSlip->id,
                    'match' => $match,
                    'league' => $request->leagues[$key] ?? null,
                    'match_date' => $request->match_dates[$key] ?? null,
                    'match_time' => $request->match_times[$key] ?? null,
                    'prediction' => $request->predictions[$key] ?? null,
                    'odds' => $request->odds[$key] ?? null,
                    'status' => $request->statuses[$key] ?? 'pending',
                ]);
            }

            DB::commit();

            logActivity('add_prediction', 'BetSlip created: ' . $betSlip->bet_code);

            return redirect()
                ->route('admin.manager.predictions.index')
                ->with('success', 'Mkeka umewekwa kikamilifu!');

        } catch (\Throwable $e) {

            DB::rollBack();

            logActivity('error', 'STORE ERROR | BetSlip create failed | ' . $e->getMessage());

            \Log::error('Prediction Store Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'user_id' => auth()->id(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Kuna tatizo limetokea wakati wa kuhifadhi mkeka.');
        }
    }

    public function create()
    {
        return view('admin.manager.predictions.create');
    }

    public function edit($id)
    {
        try {
            $betSlip = BetSlip::with('predictions')->findOrFail($id);

            return view('admin.manager.predictions.edit', compact('betSlip'));

        } catch (\Throwable $e) {

            logActivity('error', 'EDIT LOAD ERROR | BetSlip ID: ' . $id . ' | ' . $e->getMessage());

            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $betSlip = BetSlip::findOrFail($id);

            $betSlip->update([
                'bet_code' => $request->bet_code,
                'bookmaker' => $request->bookmaker,
                'betting_link' => $request->betting_link,
            ]);

            $limit = setting('daily_prediction_limit');

            $countToday = $betSlip->predictions()
                ->whereDate('created_at', today())
                ->count();

            if ($countToday >= $limit) {

                logActivity('error', 'UPDATE BLOCKED | limit reached | ' . $betSlip->bet_code);

                return back()->with('error', 'Daily prediction limit reached for updates');
            }

            $betSlip->predictions()->delete();

            if ($request->matches && is_array($request->matches)) {

                foreach ($request->matches as $key => $match) {
                    $betSlip->predictions()->create([
                        'match' => $match,
                        'league' => $request->leagues[$key] ?? null,
                        'match_date' => $request->match_dates[$key] ?? null,
                        'match_time' => $request->match_times[$key] ?? null,
                        'prediction' => $request->predictions[$key] ?? null,
                        'odds' => $request->odds[$key] ?? null,
                        'status' => $request->statuses[$key] ?? 'pending',
                    ]);
                }
            }

            logActivity('edit_prediction', 'BetSlip updated: ' . $betSlip->bet_code);

            return redirect()
                ->route('admin.manager.predictions.index')
                ->with('success', 'Updated successfully');

        } catch (\Throwable $e) {

            logActivity('error', 'UPDATE ERROR | BetSlip ID: ' . $id . ' | ' . $e->getMessage());

            return back()->with('error', 'Update failed. Try again later.');
        }
    }

    public function show($id)
    {
        try {
            $betSlip = BetSlip::with('predictions')->findOrFail($id);

            return view('admin.manager.predictions.show', compact('betSlip'));

        } catch (\Throwable $e) {

            logActivity('error', 'SHOW ERROR | BetSlip ID: ' . $id . ' | ' . $e->getMessage());

            abort(404);
        }
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,won,lost',
    ]);

    try {
        $prediction = Prediction::findOrFail($id);

        $prediction->update([
            'status' => $request->status,
        ]);

        return back()->with(
            'success',
            'Prediction status updated successfully!'
        );

    } catch (\Throwable $e) {

        \Log::error('Status Update Error', [
            'prediction_id' => $id,
            'message' => $e->getMessage(),
        ]);

        return back()->with(
            'error',
            'Failed to update prediction status.'
        );
    }
}

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $betSlip = BetSlip::findOrFail($id);

            $betSlip->predictions()->delete();
            $betSlip->delete();

            DB::commit();

            logActivity('delete_prediction', 'BetSlip deleted: ' . $betSlip->bet_code);

            return redirect()
                ->route('admin.manager.predictions.index')
                ->with('success', 'Mkeka umefutwa kikamilifu!');

        } catch (\Throwable $e) {

            DB::rollBack();

            logActivity('error', 'DELETE ERROR | BetSlip ID: ' . $id . ' | ' . $e->getMessage());

            return back()->with('error', 'Kuna tatizo: ' . $e->getMessage());
        }
    }
}