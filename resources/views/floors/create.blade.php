<!-- resources/views/buildings/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Add New floor</h1>
    <form action="{{ route('floors.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Floor Name:</label>
            <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
                <label for="manager_id" class="block text-gray-700">Assign Floor Manager</label>
                <select name="manager_id" id="manager_id" class="w-full border-gray-300 rounded mt-1">
                    <option value="">Select Manager</option>
                    @foreach($availableManagers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                    @endforeach
                </select>
            </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Floor</button>
    </form>
</div>
@endsection