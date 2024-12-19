    @extends('dashboard')

    @section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Assignment Reviews</h1>

        @foreach($assignments as $assignment)
            <div class="bg-white border border-gray-200 rounded-3xl shadow-lg mb-8 overflow-hidden">
                <div class="grid md:grid-cols-3 gap-6 p-6">
                    {{-- Left Column: Room and Assignment Details --}}
                    <div class="md:col-span-2 space-y-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $assignment->room->name }}</h2>
                                <p class="text-sm text-gray-600">Assigned to: {{ $assignment->student->name }}</p>
                            </div>
                            <span class="px-4 py-2 text-sm font-semibold
                                @if($assignment->status == 'completed') bg-green-100 text-green-800
                                @elseif($assignment->status == 'pending') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif rounded-full">
                                {{ ucfirst($assignment->status) }}
                            </span>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mb-4">
                            <p class="text-sm text-gray-600">
                                Cleaning Date: {{ \Carbon\Carbon::parse($assignment->cleaning_date)->format('l, F j') }}
                            </p>
                        </div>

                        {{-- Images Section --}}
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Cleaning Images</h3>
                            @if($assignment->hasMedia('cleaning_photos'))
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach($assignment->getMedia('cleaning_photos') as $media)
                                        <div class="relative group">
                                            <img src="{{ $media->getUrl() }}"
                                                alt="{{ $media->file_name }}"
                                                class="w-full h-48 object-cover rounded-xl shadow-md
                                                        transition duration-300 group-hover:scale-105 group-hover:shadow-xl">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                            <p class="text-gray-500 italic">No cleaning photos uploaded.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Right Column: Review Section --}}
                    <div class="bg-gray-50 rounded-2xl p-6 space-y-4">
                        @if ($assignment->reviews)
                            <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                                <div class="flex items-center mb-2">
                                @php
                                        $statusColors = [
                                            'accepted' => 'text-green-600 bg-green-50',
                                            'doubt' => 'text-yellow-600 bg-yellow-50',
                                            'not_accepted' => 'text-red-600 bg-red-50'
                                        ];
                                        $currentStatus = strtolower($assignment->reviews->status);

                                        $assignmentstatusColors = [
                                            'is pending for' => 'text-blue-600 bg-blue-50',
                                            'user did not clean' => 'text-gray-600 bg-gray-50',
                                            'Bad cleaned' => 'text-orange-600 bg-orange-50',
                                            'Well cleaned' => 'text-green-600 bg-green-50',
                                            'Rest Day' => 'text-purple-600 bg-purple-50'
                                            ];
                                        $assignmentcurrentStatus = strtolower($assignment->status);
                                    @endphp


                                    <span class="mr-3 p-2 rounded-full {{ $statusColors[$currentStatus] }}">
                                        @switch($currentStatus)
                                            @case('accepted')
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            @case('doubt')
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            @case('not_accepted')
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                </svg>
                                        @endswitch
                                    </span>

                                    <span class="font-semibold capitalize {{ $statusColors[$currentStatus] }} px-2 py-1 rounded-md text-sm">
                                        {{ str_replace('_', ' ', $assignment->reviews->status) }}
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm mt-2">
                                    {{ $assignment->reviews->comment }}
                                </p>
                            </div>
                        @else
                        @if($assignment->status == 'Rest Day')
                                Today is a rest day
                        @else
                        <form action="{{ route('assignmentreviews.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Review Status</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="review_statu" value="accepted" class="hidden peer" required>
                                        <div class="border-2 border-transparent text-center py-2 rounded-lg peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 hover:bg-gray-100 transition">
                                            <span class="text-sm font-medium">Accepted</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="review_statu" value="doubt" class="hidden peer" required>
                                        <div class="border-2 border-transparent text-center py-2 rounded-lg peer-checked:border-yellow-500 peer-checked:bg-yellow-50 peer-checked:text-yellow-700 hover:bg-gray-100 transition">
                                            <span class="text-sm font-medium">Doubt</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="review_statu" value="not_accepted" class="hidden peer" required>
                                        <div class="border-2 border-transparent text-center py-2 rounded-lg peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:text-red-700 hover:bg-gray-100 transition">
                                            <span class="text-sm font-medium">Not Accepted</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="assignment_statu" value="is pending for" class="hidden peer" required>
                                        <div class="border-2 border-transparent text-center py-2 rounded-lg peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-700 hover:bg-gray-100 transition">
                                            <span class="text-sm font-medium">is pending for</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="assignment_statu" value="user did not clean" class="hidden peer" required>
                                        <div class="border-2 border-transparent text-center py-2 rounded-lg peer-checked:border-gray-500 peer-checked:bg-gray-50 peer-checked:text-gray-700 hover:bg-gray-100 transition">
                                            <span class="text-sm font-medium">user did not clean</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="assignment_statu" value="Bad cleaned" class="hidden peer" required>
                                        <div class="border-2 border-transparent text-center py-2 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-700 hover:bg-gray-100 transition">
                                            <span class="text-sm font-medium">Bad cleaned</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="assignment_statu" value="Well cleaned" class="hidden peer" required>
                                        <div class="border-2 border-transparent text-center py-2 rounded-lg peer-checked:border-purple-500 peer-checked:bg-purple-50 peer-checked:text-purple-700 hover:bg-gray-100 transition">
                                            <span class="text-sm font-medium">Well cleaned</span>
                                        </div>
                                    </label>

                                    <label class="cursor-pointer">
                                        <input type="radio" name="assignment_statu" value="Rest Day" class="hidden peer" required>
                                        <div class="border-2 border-transparent text-center py-2 rounded-lg peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 hover:bg-gray-100 transition">
                                            <span class="text-sm font-medium">Rest Day</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Comments</label>
                                <textarea name="comment" id="comment" rows="3" class="w-full px-3 py-2 text-sm text-gray-700 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Add your review comments..." required></textarea>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                Submit Review
                            </button>
                        </form>
                    @endif
                    @endif

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endsection
