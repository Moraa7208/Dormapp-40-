@extends('dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Rooms Overview</h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($rooms as $room)
            <a href="{{ route('rooms.show', $room->id) }}"
               class="transform transition duration-300 hover:scale-105 hover:shadow-xl">
                <div class="bg-white border border-gray-200 rounded-3xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $room->name }}</h2>
                            <span class="px-3 py-1 text-sm font-semibold
                                @if($room->status == 'active') bg-green-100 text-green-800
                                @elseif($room->status == 'maintenance') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif rounded-full">
                                {{ ucfirst($room->status) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <p class="text-sm text-gray-600 mb-2">Total Students</p>
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span class="text-xl font-bold text-gray-800">
                                        {{ $room->students->count()  ?? 0 }}
                                    </span>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4 text-center">
                                <p class="text-sm text-gray-600 mb-2">Assigned Cleaners</p>
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                    <span class="text-xl font-bold text-gray-800">
                                        {{ $room->assignments->count() ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center space-x-2 text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm">{{ $room->floor->name ?? 'Unassigned Floor' }}</span>
                            </div>
                            <div class="text-sm text-gray-500">
                                Last Cleaned:
                                {{ $room->last_cleaned_at ? \Carbon\Carbon::parse($room->last_cleaned_at)->diffForHumans() : 'Never' }}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    @if($rooms->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-lg">
            <svg class="mx-auto w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
            </svg>
            <p class="text-xl text-gray-600">No rooms available</p>
        </div>
    @endif


</div>
@endsection
