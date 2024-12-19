<!-- resources/views/assign_roles.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Assign Roles</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('floor.assign.roles') }}" method="POST" class="bg-white p-6 rounded shadow-lg">
        @csrf

        <div class="mb-4">
            <label for="user" class="block text-sm font-medium text-gray-700">Select User</label>
            <select name="user_id" id="user" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
            <select name="role" id="role" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($roles as $role)
                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Assign Role
            </button>
        </div>
    </form>
</div>
@endsection
