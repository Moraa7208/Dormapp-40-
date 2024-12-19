<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Floor;
use App\Models\Room;
use App\Models\Assignment;
use App\Models\AssignmentReview;
use Carbon\Carbon;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $students = User::role('student')->wheraeNull('room_id')->get();

        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user = Auth::user();
        $floor = Floor::where('manager_id', $user->id)->first();

        Room::create([
            'name' => $request->name,
            'floor_id' => $floor->id,
        ]);
        return redirect()->route('rooms.index');
    }

    public function assignStudentsForm()
    {
        $user = Auth::user();
        $floor = Floor::where('manager_id', $user->id)->first();

        $rooms = Room::where('floor_id', $floor->id)->get();
        $students = User::role('student')->whereNull('room_id')->get();
        // $students = User::where('role', 'student')->whereNull('room_id')->get();

        return view('rooms.assign-students', compact('rooms', 'students', 'floor'));
    }

    public function assignStudents(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $room = Room::find($request->room_id);
        $student = User::find($request->user_id);

        $student->room_id = $room->id;
        $student->save();


        return redirect()->route('rooms.index')->with('success', 'Students assigned to room successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::with('students', 'assignments')->findOrFail($id);

        // Get today's assignment
        $todayAssignment = $room->assignments()->whereDate('cleaning_date', now()->toDateString())->first();

        // Check if the assignment has uploaded reviews and media
        $hasUploadedReviews = $todayAssignment ? $todayAssignment->reviews()->exists() : false;
        $hasMedia = $todayAssignment ? $todayAssignment->media()->exists() : false;

        $today = Carbon::today();

        // Get cleaning history
        $cleaningHistory = Assignment::where('room_id', $room->id)->where('cleaning_date', '<', $today)->orderBy('cleaning_date', 'desc')->take(7)->get();

        return view('rooms.show', compact('room', 'todayAssignment', 'hasUploadedReviews', 'hasMedia', 'cleaningHistory'));
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
