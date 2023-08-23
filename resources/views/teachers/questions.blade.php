@extends('teachers.master')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Questions</a></li>
                    </ol>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manage Question</h4>

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Preview
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Created Date</th>
                                        <th>Subject</th>
                                        <th>Education Level</th>
                                        <th>Education System</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>{{ $question->created_at }}</td>
                                        <td>{{ $question->exam->subject->name }}</td>
                                        <td>{{ $question->exam->subject->educationLevel->name }}</td>
                                        <td>{{ $question->exam->subject->educationSystem->name }}</td>
                                        <td>{{ $question->question }}</td>
                                        <td>{{ $question->answer }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


@section('scripts')


@endsection

