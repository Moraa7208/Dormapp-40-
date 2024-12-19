<!-- resources/views/students/upload.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6" x-data="{
        photos: [],
        previewImages(event) {
            this.photos = [...event.target.files];
        }
    }">
        <h2 class="text-2xl font-bold mb-4">Upload Cleaning Photos</h2>

        <form action="{{ route('student.upload_photos', ['assignmentId' => $assignment->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="photos">
                    Cleaning Photos
                </label>
                <input type="file" name="photos[]" id="photos" multiple
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    @change="previewImages($event)">
                @error('photos')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Preview Section -->
            <div class="mt-4" x-show="photos.length > 0">
                <h3 class="text-xl font-bold mb-2">Preview:</h3>
                <div class="grid grid-cols-2 gap-4">
                    <template x-for="(photo, index) in photos" :key="index">
                        <div>
                            <img :src="URL.createObjectURL(photo)"
                                 alt="Selected Image"
                                 class="w-32 h-32 object-cover rounded">
                        </div>
                    </template>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">You can upload multiple photos by holding the Ctrl (or Command) key while selecting files.</p>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Upload
            </button>
        </form>
    </div>
</div>
@endsection
