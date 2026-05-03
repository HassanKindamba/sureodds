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
            ]);
        }

        DB::commit();

        return redirect()
            ->route('admin.manager.predictions.index')
            ->with('success', 'Mkeka umewekwa kikamilifu!');

    } catch (\Throwable $e) {

        DB::rollBack();

        // LOG ERROR (for developer)
        \Log::error('Prediction Store Error: ' . $e->getMessage(), [
            'line' => $e->getLine(),
            'file' => $e->getFile(),
        ]);

        // USER FRIENDLY MESSAGE
        return back()
            ->withInput()
            ->with('error', 'Kuna tatizo limetokea wakati wa kuhifadhi mkeka. Tafadhali jaribu tena.');
    }
}


    public function create()
    {
        return view('admin.manager.predictions.create');
    }

    public function edit($id)
    {
        $betSlip = BetSlip::with('predictions')->findOrFail($id);

        return view('admin.manager.predictions.edit', compact('betSlip'));
    }

    public function update(Request $request, $id)
{
    $betSlip = BetSlip::findOrFail($id);

    $betSlip->update([
        'bet_code' => $request->bet_code,
        'bookmaker' => $request->bookmaker,
        'betting_link' => $request->betting_link,
    ]);

    // 🔒 LIMIT CONTROL (optional but recommended)
    $limit = setting('daily_prediction_limit');

    $countToday = $betSlip->predictions()
        ->whereDate('created_at', today())
        ->count();

    if ($countToday >= $limit) {
        return back()->with('error', 'Daily prediction limit reached for updates');
    }

    // delete old matches
    $betSlip->predictions()->delete();

    // 🛡️ safety check
    if ($request->matches && is_array($request->matches)) {

        // insert new matches
        foreach ($request->matches as $key => $match) {
            $betSlip->predictions()->create([
                'match' => $match,
                'league' => $request->leagues[$key] ?? null,
                'match_date' => $request->match_dates[$key] ?? null,
                'match_time' => $request->match_times[$key] ?? null,
                'prediction' => $request->predictions[$key] ?? null,
                'odds' => $request->odds[$key] ?? null,
            ]);
        }
    }

    return redirect()
        ->route('admin.manager.predictions.index')
        ->with('success', 'Updated successfully');
}
        public function show($id)
    {
        $betSlip = BetSlip::with('predictions')->findOrFail($id);

        return view('admin.manager.predictions.show', compact('betSlip'));
    }

    public function destroy($id)
{
    DB::beginTransaction();

    try {

        $betSlip = BetSlip::findOrFail($id);

        // delete all related predictions first
        $betSlip->predictions()->delete();

        // delete bet slip
        $betSlip->delete();

        DB::commit();

        return redirect()
            ->route('admin.manager.predictions.index')
            ->with('success', 'Mkeka umefutwa kikamilifu!');

    } catch (\Throwable $e) {

        DB::rollBack();

        return back()
            ->with('error', 'Kuna tatizo: ' . $e->getMessage());
    }
}
}