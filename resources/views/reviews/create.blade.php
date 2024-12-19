<!-- resources/views/reviews/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Review Assignment</h2>
        <form action="{{ route('reviews.store', ['assignmentId' => $assignment->id]) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Review Status
                </label>
                <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="accepted">Accepted</option>
                    <option value="doubt">Doubt</option>
                    <option value="not_accepted">Not Accepted</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="comment">
                    Comment
                </label>
                <textarea name="comment" id="comment" rows="4"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                @error('comment')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Submit Review
            </button>
        </form>
    </div>
</div>
@endsection
