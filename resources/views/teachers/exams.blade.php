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
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Create Exam
                    </button>

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
        <!-- Add Questions Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create an Exam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{ route('store_exams') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="subject" class="col-md-4 col-form-label text-md-end">Subject</label>
                                <div class="col-md-6">
                                    <select id="subject" name="subject_id" class="form-control">
                                        <option value="">Select Subject</option>

                                    </select>
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                                        <th>Exam Name</th>
                                        <th>Education Level</th>
                                        <th>Education System</th>
                                        <th>Subject</th>
                                        <th>No Questions</th>
                                        <th>No Topics</th>
                                        <th>No Sub Topics</th>
                                        <th>Add Questions</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($exams as $exam)

                                        <tr>
                                            <td>{{ $exam->name }}</td>
                                            <td>{{ $exam->subject->educationLevel->name}}</td>
                                            <td>{{ $exam->subject->educationSystem->name }}</td>
                                            <td>{{ $exam->subject->name }}</td>
                                            <td>{{ $exam->questions_count }}</td>
                                            <td>{{ $topics_subtopics_counts[$exam->id]["topicStrands"] }}</td>
                                            <td>{{ $topics_subtopics_counts[$exam->id]["subTopicStrands"]  }}</td>
                                            <td><a href="{{ route('create_question', ['examId' => $exam->id]) }}" title="Add Question"><i class="mdi mdi-file-question-outline"></i></a></td>

                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_{{ $exam->id }}" title="Edit"><i class="mdi mdi-book-edit-outline"></i></a>

                                                <a href="#"  title="Delete" onclick="event.preventDefault(); deleteStudent('{{ route('delete_exams', $exam->id) }}');">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </a>

                                                <form id="delete-form" method="POST" action="{{ route('delete_exams', $exam->id) }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal_{{ $exam->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Exams</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm_{{ $exam->id }}" method="POST" action="">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Edit Subscription Plan Form fields -->

                                                                <div class="row mb-3">
                                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Exam Name') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="name" type="text" value="{{ $exam->name }}"  class="form-control @error('name') is-invalid @enderror" name="name"  required >

                                                                        @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="subject" class="col-md-4 col-form-label text-md-end">Subject</label>
                                                                    <div class="col-md-6">
                                                                        <select id="subject" name="subject_id" class="form-control">
                                                                            <option value="">Select Subject</option>

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-0">
                                                                    <div class="col-md-6 offset-md-4">
                                                                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- third party js -->
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.select.min.js') }}"></script>

    <script>
    // Populate education levels based on education system selection
    $('#education_system').on('change', function () {
        var educationSystemId = $(this).val();
        $.ajax({
            url: '/teacher/get-education-levels',
            type: 'GET',
            data: {educationSystemId: educationSystemId},
            success: function (data) {
                var options = '<option value="">Select Education Level</option>';

                $.each(data.educationLevels, function (key, educationLevel) {
                    options += '<option value="' + educationLevel.id + '">' + educationLevel.name + '</option>';
                });

                $('#education_level').html(options);
            }
        });
    });

    // Populate subjects based on education level selection
    $.ajax({
        url: '/teacher/get-subjects',
        type: 'GET',
        success: function (data) {
            console.log(data);
            var options = '<option value="">Select Subject</option>';
            $.each(data.subjects, function (key, subject) {
                options += `<option value="${subject.id}">${subject.name} - ${subject.education_level.name} - ${subject.education_system.name}</option>`;
                // options += '<option value="' + subject.id + '">' + subject.name + '</option>';
            });
            $('#subject').html(options);
        }
    });

    function deleteStudent(deleteUrl) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the deletion by submitting the form
                document.getElementById('delete-form').action = deleteUrl;
                document.getElementById('delete-form').submit();
            }
        });
    }

    </script>

@endsection

