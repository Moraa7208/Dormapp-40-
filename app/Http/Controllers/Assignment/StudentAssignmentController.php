<?php

namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;



class StudentAssignmentController extends Controller
{

    public function showUploadForm($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        return view('students.upload', compact('assignment'));
    }

    public function uploadCleaningPhotos(Request $request, $assignmentId)
{
    $request->validate([
        'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $assignment = Assignment::findOrFail($assignmentId);

    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $assignment->addMedia($photo)->toMediaCollection('cleaning_photos');
        }
    }

    return redirect()->route('student.room')->with('success', 'Photos uploaded successfully');
 }
}
