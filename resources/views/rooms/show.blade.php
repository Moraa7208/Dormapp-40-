@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        {{-- Room Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $room->name }}</h1>
            <div class="text-sm text-gray-600">
                Total Roommates: {{ $room->students->count() }}
            </div>
        </div>

        {{-- Roommates Section --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Roommates</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($room->students as $student)
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 hover:bg-gray-100 transition-all duration-200 flex items-center space-x-6">
                        <img class="h-32 w-32 rounded-full object-cover"
                             src="{{ $student->profile_photo_url ?? 'https://via.placeholder.com/128' }}"
                             alt="{{ $student->name }}">
                        <div>
                            <div class="text-2xl font-semibold text-gray-900">{{ $student->name }}</div>
                            <div class="text-lg text-gray-500">{{ $student->email }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Today's Assignment Section --}}
        <div class="mb-6 bg-blue-50 border border-blue-100 rounded-lg p-4">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Today's Assignment</h2>
            @if($todayAssignment)
                @if($todayAssignment->student->name == 'Rest Day')
                    <p class="text-gray-600">Today is a Rest Day. No one is assigned to clean.</p>
                @else
                    <div class="flex items-center justify-between">
                        <div>
                            @if ($hasUploadedReviews)
                                <p class="text-lg">
                                    <span class="font-medium">Assignment of {{ \Carbon\Carbon::parse($todayAssignment->cleaning_date)->format('l, F j') }} has been checked by {{ $todayAssignment->room->floor->manager->name }} and {{ $todayAssignment->reviews->status }}</span>
                                </p>
                            @elseif ($hasMedia)
                                <p class="text-lg">
                                    <span class="font-medium">Assignment of {{ \Carbon\Carbon::parse($todayAssignment->cleaning_date)->format('l, F j') }} is awaiting review by {{ $todayAssignment->room->floor->manager->name }}</span>
                                </p>
                            @else
                                <p class="text-lg">
                                    <span class="font-medium">Assignment of {{ \Carbon\Carbon::parse($todayAssignment->cleaning_date)->format('l, F j') }} is assigned to {{ $todayAssignment->student->name }}</span>
                                </p>
                            @endif
                        </div>
                        <a href="{{ route('student.upload_photos_form', ['assignmentId' => $todayAssignment->id]) }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                            Upload Cleaning Photos
                        </a>
                    </div>
                @endif
            @else
                <p class="text-gray-600">No assignment for today.</p>
            @endif
        </div>

        {{-- Cleaning History Section --}}
        <div>
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Cleaning History</h2>
            <div class="bg-gray-50 rounded-lg">
                @if($cleaningHistory->count())
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cleaner</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="p-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Review</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($cleaningHistory as $history)
                                <tr class="hover:bg-gray-100 transition-colors">
                                    <td class="p-3 text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($history->cleaning_date)->format('l, F j') }}
                                    </td>
                                    <td class="p-3 text-sm text-gray-900">
                                        {{ $history->student->name }}
                                    </td>
                                    <td class="p-3 text-sm">
                                        <span class="
                                            {{ $history->status == 'completed' ? 'text-green-600 bg-green-50' :
                                               ($history->status == 'pending' ? 'text-yellow-600 bg-yellow-50' : 'text-gray-600 bg-gray-50') }}
                                            px-2 py-1 rounded-full text-xs font-medium">
                                            {{ ucfirst($history->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-sm">
                                        <span class="
                                            {{ $history->status == 'completed' ? 'text-green-600 bg-green-50' :
                                               ($history->status == 'pending' ? 'text-yellow-600 bg-yellow-50' : 'text-gray-600 bg-gray-50') }}
                                            px-2 py-1 rounded-full text-xs font-medium">
                                            @if(ucfirst($history->status) == 'Rest Day')
                                                {{ ucfirst($history->status) }}
                                            @else
                                                {{ $history->reviews->status ?? 'Not Reviewed' }}
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="p-4 text-gray-600 text-center">No cleaning history available.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
