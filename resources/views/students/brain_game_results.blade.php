@extends('students.master')

@section('content')
    <div class="container text-center">
        <h4>View Results</h4>
        <h4>Brain Game: {{ $brain_result->name }}</h4>

        <div class="card mx-auto" style="width: 18rem;">
            <div class="card-body">
                <h4 class="card-title">Congratulations! 🎉</h4>
                <p class="card-text">You got <strong>{{ $brain_result->yes_ans }}</strong> out of <strong>{{ $brain_result->yes_ans + $brain_result->no_ans }}</strong></p>
            </div>
        </div>
    </div>
@endsection

