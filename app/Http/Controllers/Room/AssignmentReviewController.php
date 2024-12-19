<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentReview;
use Carbon\Carbon;

class AssignmentReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today();
        $assignments = Assignment::with(['reviews', 'student', 'room'])->orderBy('created_at', 'desc')
        ->get();
        // $AssignmentReviews = AssignmentReview

        return view('reviews.index', [
            'assignments' => $assignments,
            'today' => $today
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'comment' => 'nullable|string',
        ]);

        $assignment = Assignment::find($request->assignment_id);
        $assignment->status = $request->assignment_statu;
        $assignment->save();

        AssignmentReview::create([
            'assignment_id' => $request->assignment_id,
            'user_id' => $request->user_id,
            'status' => $request->review_statu,
            'comment' => $request->comment,
        ]);

        return redirect()->route('assignmentreviews.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
