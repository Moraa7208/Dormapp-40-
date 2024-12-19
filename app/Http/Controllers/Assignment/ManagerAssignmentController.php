<?php
namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Assignment;
use App\Models\AssignmentReview;
use Illuminate\Support\Facades\Auth;



class ManagerAssignmentController extends Controller
{
        use HasFactory, InteractsWithMedia;

    public function create($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        return view('reviews.create', compact('assignment'));
    }

    public function store(Request $request, $assignmentId)
    {
        $request->validate([
            'status' => 'required|in:accepted,doubt,not_accepted',
            'comment' => 'nullable|string',
        ]);

        AssignmentReview::create([
            'assignment_id' => $assignmentId,
            'user_id' => Auth::id(),
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

        return redirect()->route('student.room', $assignmentId)->with('success', 'Review submitted successfully.');
    }
}
