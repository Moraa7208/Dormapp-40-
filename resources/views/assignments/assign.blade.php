@extends('layouts.app')

@section('content')
    <h1>Today's Assignment</h1>
    @if(isset($message))
        <p>{{ $message }}</p>
    @else
        <p>Student: {{ $assignedStudent }}</p>
        <p>Cleaning Date: {{ $cleaningDate->format('Y-m-d') }}</p>
    @endif
@endsection
