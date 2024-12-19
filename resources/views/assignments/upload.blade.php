@extends('layouts.app')

@section('content')
    <h1>Upload Cleaning Photos</h1>
    <form action="{{ route('assignments.upload', $assignment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="photos">Upload Photos:</label>
        <input type="file" name="photos[]" multiple required>
        <button type="submit">Upload</button>
    </form>
@endsection
