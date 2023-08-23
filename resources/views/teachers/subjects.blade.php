@extends('teachers.master')

@section('content')


<div class="container-fluid">                    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Subjects</a></li>
                    </ol>
                </div>
                <br>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add a Subject
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

    <!-- Scrollable modal -->

    <!-- Add Questions Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add a Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="POST" action="">
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

    <!-- Add topics or Strand modal -->
    <div class="modal fade" id="topicsBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="topicsBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add a Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="POST">
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
    <!-- End of Topics And Strands -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Manage Subjects</h4>


                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#buttons-table-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Preview
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
                                        <th>Subject Name</th>
                                        <th>No Topics/Strands</th>
                                        <th>Add Topics</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                    <tr>

                                        <td>{{$subject->educationSystem->name}}</td>
                                        <td>{{$subject->educationLevel->name}}</td>
                                        <td>{{$subject->name}}</td>
                                        <td>{{ $subject->topicsCount }}</td>

                                        @if($subject->educationSystem->name === 'CBC')
                                            <td>
                                                <a href="{{ route('topics_strands.index', ['educationSystemId' => $subject->educationSystem->id, 'educationLevelId' => $subject->educationLevel->id, 'subjectId' => $subject->id]) }}" title="Topic">
                                                    <i class="mdi mdi-book-edit-outline"></i> Add Topics
                                                </a>
                                            </td>

                                        @elseif($subject->educationSystem->name === '8.4.4')
                                            <td>
                                                <a href="{{ route('topics_strands.index', ['educationSystemId' => $subject->educationSystem->id, 'educationLevelId' => $subject->educationLevel->id, 'subjectId' => $subject->id]) }}" title="Topic">
                                                    <i class="mdi mdi-book-edit-outline"></i> Add Topics
                                                </a>
                                            </td>

                                        @else
                                        @endif

                                        <td>
                                            <a href="" title="View"><i class="mdi mdi-eye"></i></a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_{{ $subject->id }}" title="Edit"><i class="mdi mdi-book-edit-outline"></i></a>

                                            <a href="#"  title="Delete" onclick="event.preventDefault(); deleteStudent('{{ route('delete_subjects', $subject->id) }}');">
                                                <i class="mdi mdi-trash-can-outline"></i>
                                            </a>

                                            <form id="delete-form" method="POST" action="{{ route('delete_subjects', $subject->id) }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal_{{ $subject->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editForm_{{ $subject->id }}" method="POST" action="">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Edit Subscription Plan Form fields -->
                                                            <div class="row mb-3">
                                                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Subject Name') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="name"  value="{{ $subject->name }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>

                                                                    @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>


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
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>


    <!-- end row-->
</div> <!-- container -->

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
            });

            // Function to handle next button click on the wizard form
            function next() {
                var currentTab = $('.tab-pane.active');
                var nextTab = currentTab.next('.tab-pane');

                if (nextTab.length > 0) {
                    currentTab.removeClass('active');
                    nextTab.addClass('active');
                }
            }

            // Function to handle previous button click on the wizard form
            function previous() {
                var currentTab = $('.tab-pane.active');
                var prevTab = currentTab.prev('.tab-pane');

                if (prevTab.length > 0) {
                    currentTab.removeClass('active');
                    prevTab.addClass('active');
                }
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
