<?php

namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Assignment;
use App\Models\AssignmentReview;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function assignCleaningTask()
    {
        // Get the current user (student) and their room
        $student = auth()->user();
        $room = $student->room;
        $roommates = $room->students; // Assume students relationship exists


        // $AssignmentReview =
        // Get today's date
        $today = Carbon::today();


        // Check if an assignment already exists for today
        $existingAssignment = Assignment::where('room_id', $room->id)
        ->where('cleaning_date', $today)
        ->first();

        $stringtoday = Carbon::today()->toDateString();

        if ($existingAssignment) {
            $hasMedia = $existingAssignment->media()->whereDate('created_at', $stringtoday)->exists();

            $hasUploadedReviews = AssignmentReview::where('assignment_id', $existingAssignment->id)
            ->whereDate('created_at', $today)
            ->exists();

            $review = \App\Models\AssignmentReview::where('assignment_id', $existingAssignment->id)->first();
            // @dd($hasUploadedReviews);

            return view('students.room', [
                'room' => $room,
                'assignment' => $existingAssignment,
                'hasUploadedReviews' => $hasUploadedReviews,
                'hasMedia' => $hasMedia,
                'review' => $review,
                'cleaningHistory' => Assignment::where('room_id', $room->id)->where('cleaning_date', '<', $today)->orderBy('cleaning_date', 'desc')->take(7)->get(),
            ]);
        }

        // Calculate the total number of students in the room
        $totalStudents = count($roommates);

        // Determine which student is assigned to clean today based on the rotation
        $cleaningDay = $today->dayOfYear;
        $studentIndex = ($cleaningDay - 1) % ($totalStudents + 1); // +1 to account for rest day

        if ($studentIndex == $totalStudents) {
            // If it's a rest day, create a rest day assignment
            $assignment = new Assignment([
                'room_id' => $room->id,
                'cleaning_date' => $today,
                'status' => 'Rest Day',
            ]);
            $assignment->save();

            return view('students.room', [
                'room' => $room,
                'message' => 'Today is a rest day. No one is assigned to clean.',
                'cleaningDate' => $today,
                'assignment' => $assignment,
                'cleaningHistory' => Assignment::where('room_id', $room->id)->where('cleaning_date', '<', $today)->orderBy('cleaning_date', 'desc')->take(7)->get(),
            ]);
        }

        // Assign the cleaning task to the student
        $assignedStudent = $roommates[$studentIndex];

        // Create the cleaning assignment for the assigned student
        $assignment = new Assignment([
            'user_id' => $assignedStudent->id,
            'room_id' => $room->id,
            'cleaning_date' => $today,
            'status' => 'is pending for',
        ]);

        $assignment->save();

        // Get the cleaning history for the room
        $cleaningHistory = Assignment::where('room_id', $room->id)
            ->where('cleaning_date', '<', $today)
            ->orderBy('cleaning_date', 'desc')
            ->take(7)
            ->get();

        // Return the view with the assignment and cleaning history
        return view('students.room', [
            'room' => $room,
            'assignment' => $assignment,
            'cleaningHistory' => $cleaningHistory,
        ]);
    }
}
