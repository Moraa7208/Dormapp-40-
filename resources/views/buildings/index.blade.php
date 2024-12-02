<!-- resources/views/builds/index.blade.php -->
@extends('dashboard') <!-- Extending the dashboard layout -->

@section('content')
    <div class="flex justify-center mt-4 mb-4">
    <a href="{{ route('buildings.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg text-2xl">
            Create New Building
        </a>
    </div>
    <div class="flex justify-center mt-4 mb-4">
    <a href="{{ route('assign.roles.form') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg text-2xl">
          Assign roles form
        </a>
    </div>

    <!-- Your content for the building list goes here -->
@endsection
