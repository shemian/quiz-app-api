@extends('students.master')

@section('content')

    <div class="container">
        @error('error')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <div class="row">
            @foreach ($exams as $exam)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $exam->name }}</h5>
                            <p>Subject: {{ $exam->subject->name }}</p>
                            <p>For: {{ $exam->subject->educationLevel->name }}</p>
                            @php
                                $result = auth()->user()->student->results->where('exam_id', $exam->id)->first();
                            @endphp
                            @if ($result)
                                <button class="btn btn-danger" disabled>Exam Attempted</button>
                            @else
                                <a href="{{ route('show_questions', $exam->id) }}" class="btn btn-primary">Attempt Exam</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
