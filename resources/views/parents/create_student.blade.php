
@extends('parents.master')

@section('content')


    <div class="container-fluid">                    <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">My Students</a></li>
                        </ol>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add a Student
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

        <!-- Create student Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add a Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{ route('store_student') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Student Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="date_of_birth" class="col-md-4 col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" required>

                                    @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="school_name" class="col-md-4 col-form-label text-md-end">{{ __('School Name') }}</label>

                                <div class="col-md-6">
                                    <input id="school_name" type="text" class="form-control @error('school_name') is-invalid @enderror" name="school_name" required>

                                    @error('school_name')
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

                            <div class="row mb-3">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-end">{{ __('Student Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control @error('student_phone_number') is-invalid @enderror" name="phone_number" >

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Student') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Plan Modal -->
        <div class="modal fade" id="planmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Choose A Plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="">
                            @csrf

                            <div class="row mb-3">
                                <label for="subscription_plan" class="col-md-4 col-form-label text-md-end">{{ __('Select a Plan' ) }}</label>

                                <div class="col-md-6">
                                    <select id="subscription_plan" name="subscription_plan" class="form-control @error('subscription_plan') is-invalid @enderror">
                                        <option value="">Select a Plan</option>
                                        @foreach($subscription_plans as $subscription_plan)
                                            <option value="{{ $subscription_plan->name }}">{{ $subscription_plan->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('subscription_plan')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="subscription_plan_price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input id="subscription_plan_price" type="text" class="form-control @error('subscription_plan_price') is-invalid @enderror" name="subscription_plan_price" required autofocus disabled>

                                    @error('subscription_plan_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-primary" id="purchase_plan">
                                        {{ __('Purchase Plan') }}
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

                        <h4 class="header-title">Manage Students</h4>


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
                                        <th>Name</th>
                                        <th>CentyPlus ID</th>
                                        <th>Class </th>
                                        <th>School</th>
                                        <th>Wallet Balance</th>
                                        <th>Centiis</th>
                                        <th>Account Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->user->centy_plus_id }}</td>
                                            <td>{{ $student->EducationLevel->name }}</td>
                                            <td>{{ $student->school_name }}</td>
                                            <td>{{ $student->debit }}</td>
                                            <td>{{ $student->centy_balance }}</td>
                                            @if($student->account_status == 1)
                                                <td>Active</td>
                                            @elseif($student->account_status == 0 || $student->account_status == 2)
                                                <td>
                                                    <a href="" title="Activate Account" data-student-id="{{ $student->id }}" id="activate-account-link" data-bs-toggle="modal" data-bs-target="#planmodal">
                                                        <i class="mdi mdi-book-edit-outline"></i>Activate
                                                    </a>
                                                </td>
                                            @elseif($student->account_status == 3)
                                                <td>Suspended</td>
                                            @endif

                                            <td>
                                                <a href="{{ route('view_student_details', $student->id) }}" title="View"><i class="mdi mdi-eye"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_{{ $student->id }}" title="Edit"><i class="mdi mdi-book-edit-outline"></i></a>

                                                <a href="#"  title="Delete" onclick="event.preventDefault(); deleteStudent('{{ route('delete_student', $student->id) }}');">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </a>

                                                <form id="delete-form" method="POST" action="{{ route('delete_student', $student->id) }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </td>

                                            <!-- Edit Subscription Plan Modal -->
                                            <div class="modal fade" id="editModal_{{ $student->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm_{{ $student->id }}" method="POST" action="">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Edit Subscription Plan Form fields -->
                                                                <div class="row mb-3">
                                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Student Name') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="name"  value="{{ $student->user->name }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>

                                                                        @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="date_of_birth" class="col-md-4 col-form-label text-md-end">{{ __('Date Of Birth') }}</label>
                                                                    <div class="col-md-6">
                                                                        <input id="date_of_birth" type="date" value="{{ $student->date_of_birth }}"class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" required>

                                                                        @error('date_of_birth')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="school_name" class="col-md-4 col-form-label text-md-end">{{ __('School Name') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="school_name" value="{{ $student->school_name }}" type="text" class="form-control @error('school_name') is-invalid @enderror" name="school_name" required>

                                                                        @error('school_name')
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

    <script>
        let studentId = null;
        $(document).ready(function() {

            // When the education system dropdown value changes
            $('#education_system_id').on('change', function() {
                var educationSystemId = $(this).val();

                // Make an AJAX request to fetch the education levels for the selected education system
                $.ajax({
                    url: '{{ route('get_education_levels') }}',
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
            });

            const subscription_plans = @json($subscription_plans);

            // When the subscription plan dropdown value changes
            $('#subscription_plan').change(function() {
                var planId = $(this).val();
                var selectedPlan = subscription_plans.find(function(plan) {
                    return plan.name === planId;
                });

                // Display the price of the selected plan
                $('#subscription_plan_price').val(selectedPlan.price);
            });

            $(document).on('click', '#activate-account-link', function(e) {
                e.preventDefault();
                studentId = $(this).data('student-id');
                console.log('Student ID:', studentId);
            });

            //send form request to activate student account
            $('#purchase_plan').on('click', function(e) {
                e.preventDefault();

                // Make an AJAX request to fetch the education levels for the selected education system
                $.ajax({
                    url: '{{ route('stk_push') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        student_id: studentId,
                        subscription_plan_price: $('#subscription_plan_price').val(),
                        subscription_plan_name: $('#subscription_plan').val(),
                    },
                    success: function(response) {
                        console.log(response);
                        $('#planmodal').modal('toggle');
                        alert(response.message);
                        if (response.success === "0") {
                            console.log(response);
                            window.location.href = "{{ route('get_students') }}";
                        }
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

@section('scripts')


    @if(Session::has('formData'))
        <script>
            // Restore form data from session
            var formData = {!! json_encode(Session::get('formData')) !!};
            Object.keys(formData).forEach(function(key) {
                document.getElementById(key).value = formData[key];
            });
        </script>
    @endif
@endsection



