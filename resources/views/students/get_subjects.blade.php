@extends('students.master')

@section('content')

<div class="container">
    <div class="row">
        @foreach ($subjects as $subject)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $subject->name }}</h5>
                        <p>For: {{ $subject->educationLevel->name }}</p>
                        <a href="{{ route('show_questions', $subject->id) }}" class="btn btn-primary">View Questions</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



@endsection
