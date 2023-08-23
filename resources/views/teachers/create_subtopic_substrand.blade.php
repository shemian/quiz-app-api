@extends('teachers.master')

@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Teacher</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Subjects</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Topics</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Subtopics</a></li>
                        </ol>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add a Sub-Topic
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
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">Manage Topics</h4>


                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                    Topics/Strands
                                </a>
                            </li>

                        </ul> <!-- end nav-->
                        <div class="tab-content">
                            <div class="tab-pane show active" id="buttons-table-preview">
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>Education System</th>
                                        <th>Education Level</th>
                                        <th>Subject</th>
                                        <th>Topics/Strands</th>
                                        <th>Sub Topic name</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($topicStrands as $topicStrand)
                                        <tr>
                                            <td>{{ $topicStrand->subject->educationSystem->name }}</td>
                                            <td>{{ $topicStrand->subject->educationLevel->name }}</td>
                                            <td>{{ $topicStrand->subject->name }}</td>
                                            <td>{{ $topicStrand->topic_strand }}</td>
                                            <td>

                                                @foreach($subtopics->where('topic_strand_id', $topicStrand->id) as $subtopic)
                                                    <li>{{ $subtopic->name }}</li>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end preview-->

                        </div> <!-- end tab-content-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

        <!-- Add topics Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add a Topic</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{ route('storeSubtopicSubStrand') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="education_system_id" class="col-md-4 col-form-label text-md-end">{{ __('Education System') }}</label>

                                <div class="col-md-6">
                                    <select id="education_system_id" name="education_system_id" class="form-control @error('education_system_id') is-invalid @enderror">
                                        <option value="">Select an Education System</option>
                                        @foreach($education_systems as $education_system)
                                            <option value="{{ $education_system->id }}">{{ $education_system->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('education_system_id')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="education_level_id" class="col-md-4 col-form-label text-md-end">{{ __('Education Level') }}</label>

                                <div class="col-md-6">
                                    <select id="education_level_id" name="education_level_id" class="form-control @error('education_level_id') is-invalid @enderror">
                                        <option value="">Select an Education Level</option>
                                        <!-- This options will be dynamically populated based on the selected education system -->
                                    </select>

                                    @error('education_level_id')
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

                            <div class="row mb-3">
                                <label for="topic_strand" class="col-md-4 col-form-label text-md-end">Topic </label>
                                <div class="col-md-6">
                                    <select id="topic_strand" name="topic_strand_id" class="form-control">
                                        <option value="">Select Topic</option>

                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Subtopic Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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

    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(Session::has('formData'))
        <script>
            // Restore form data from session
            var formData = {!! json_encode(Session::get('formData')) !!};
            Object.keys(formData).forEach(function(key) {
                document.getElementById(key).value = formData[key];
            });
        </script>
    @endif
    <script>

        $(document).ready(function() {
            // When the education system dropdown value changes
            $('#education_system_id').on('change', function() {
                var educationSystemId = $(this).val();

                // Make an AJAX request to fetch the education levels for the selected education system
                $.ajax({
                    url: '{{ route('getEducationLevels') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        education_system_id: educationSystemId
                    },
                    success: function(response) {
                        var options = '<option value="">Select an Education Level</option>';

                        // Populate the education levels dropdown with the retrieved options
                        for (var i = 0; i < response.length; i++) {
                            options += '<option value="' + response[i].id + '">' + response[i].name + '</option>';
                        }

                        $('#education_level_id').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                // Show the "topicsBackdrop" modal when the "Add a Topic" button is clicked
                $('#datatable-buttons').on('click', '.btn-primary[data-target="#topicsBackdrop"]', function() {
                    $('#topicsBackdrop').modal('show');
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

            });

            $('#subject').on('change', function () {
                // Populate subjects based on education level selection
                const subjectId = $(this).val();

                $.ajax({
                    url: `/teacher/get-topics/${subjectId}`,
                    type: 'GET',
                    success: function (data) {
                        console.log(data);
                        var options = '<option value="">Select Topics</option>';

                        $.each(data.topicStrands, function (key, topic_strand) {
                            options += `<option value="${topic_strand.id}">${topic_strand.topic_strand} </option>`;
                        });

                        $('#topic_strand').html(options);
                    }
                });

            })


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
