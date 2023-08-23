@extends('layouts.master')

@section('content')


<div class="container-fluid">                    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Students</a></li>
                    </ol>
                </div>
                <br>
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



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Manage Customers </h4>

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
                                        <th>Guardian Name</th>
                                        <th>Guardian Phone No</th>
                                        <th>Account Number</th>
                                        <th>School Name</th>
                                        <th>Centiis</th>
                                        <th>Active Subscription</th>
                                        <th>Account Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->user->name }}</td>
                                    <td><a href="{{ route('view_parent_details', $student->guardian_id) }}"  title=""> {{ $student->guardian->user->name}}</a></td>
                                    <td>{{ $student->guardian->user->phone_number}}</td>
                                    <td>{{ $student->user->centy_plus_id }}</td>
                                    <td>{{ $student->school_name }}</td>
                                    <td>{{ $student->credit }}</td>
                                    <th>{{$student->active_subscription}}</th>
                                    <td>
                                        @if($student->account_status === 1)
                                            Active
                                        @elseif($student->account_status === 2)
                                            Pending
                                        @elseif($student->account_status === 0)
                                            Inactive
                                        @elseif($student->account_status === 3)
                                            Suspended
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" title="View"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_{{ $student->id }}" title="Edit"><i class="mdi mdi-book-edit-outline"></i></a>

                                        <a href="#"  title="Delete" onclick="event.preventDefault(); deleteStudent('{{ route('destroy_student_account', $student->id) }}');">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </a>

                                        <form id="delete-form" method="POST" action="{{ route('destroy_student_account', $student->id) }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>

                                    <!-- Edit Subscription Plan Modal -->
                                    <div class="modal fade" id="editModal_{{ $student->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Change Account Status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editForm_{{ $student->id }}" method="POST" action="{{ route('update_student_account_status', ['id' => $student->id]) }}">
                                                    @csrf
                                                        @method('PUT')

                                                        <!-- Edit Subscription Plan Form fields -->
                                                        <div class="row mb-3">
                                                            <label for="account_status" class="col-md-4 col-form-label text-md-end">{{ __('Account Status') }}</label>


                                                            <div class="col-md-6">
                                                                <select id="account_status" name="account_status" class="form-control @error('account_status') is-invalid @enderror">
                                                                    <option value="{{ $student->account_status }}">Select Account Status</option>
                                                                    <option value="1">Active</option>
                                                                    <option value="2">Pending</option>
                                                                    <option value="0">Inactive</option>
                                                                    <option value="3">Suspended</option>
                                                                </select>

                                                                @error('account_status')
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

                                <tbody>

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
