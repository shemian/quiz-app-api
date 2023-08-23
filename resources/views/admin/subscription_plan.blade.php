@extends('layouts.master')

@section('content')

    <div class="container-fluid">                    <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Subscription Plans</a></li>
                        </ol>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Create a Subscription Plan
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

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create a Subscription Plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="POST" action="{{ route('subscriptions.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select" id="name" aria-label="Default select example" @error('name') is-invalid @enderror" name="name"  required >
                                    <option selected>Select Validity Unit</option>
                                    <option value="daily">DAILY </option>
                                    <option value="weekly">WEEKLY</option>
                                    <option value="monthly">MONTHLY</option>
                                    </select>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input id="price" min="0" max="10000" step="1" class="form-control @error('price') is-invalid @enderror" name="price"  required placeholder="0.00">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="validity" class="col-md-4 col-form-label text-md-end">{{ __('Validity Unit') }}</label>

                                <div class="col-md-6">
                                    <input id="validity" min="0" max="10000" step="1" class="form-control @error('validity') is-invalid @enderror" name="validity"  required placeholder="Number of Days">

                                    @error('validity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description" rows="10" placeholder="Description">
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
                        <h4 class="header-title">Manage Subscription Plan</h4>

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
                                        <th>Plan Duration</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subscriptionPlans as $subscriptionPlan)
                                        <tr>
                                            <td>{{ $subscriptionPlan->updated_at }}</td>
                                            <td>{{ $subscriptionPlan->name }}</td>
                                            <td>{{ $subscriptionPlan->price }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-link edit-button" data-bs-toggle="modal" data-bs-target="#editModal_{{ $subscriptionPlan->id }}" title="Edit"><i class="mdi mdi-book-edit-outline"></i></button>

                                                <!-- Delete Button -->
                                                <form method="POST" action="{{ route('subscriptions.destroy', $subscriptionPlan->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Subscription Plan Modal -->
                                        <div class="modal fade" id="editModal_{{ $subscriptionPlan->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Subscription Plan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editForm_{{ $subscriptionPlan->id }}" method="POST" action="{{ route('subscriptions.update', $subscriptionPlan->id) }}">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Edit Subscription Plan Form fields -->
                                                            <div class="row mb-3">
                                                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="name" type="text" class="form-control" name="name" value="{{ $subscriptionPlan->name }}" required>
                                                                </div>

                                                            </div>

                                                            <div class="row mb-3">
                                                                <label for="validity" class="col-md-4 col-form-label text-md-end">{{ __('Validity Unit') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="validity" min="0" max="10000" step="1" class="form-control @error('validity') is-invalid @enderror" name="validity" value="{{ $subscriptionPlan->validity }}" required>

                                                                    @error('validity')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="price" type="number" class="form-control" name="price" value="{{ $subscriptionPlan->price }}" required>
                                                                </div>
                                                            </div>

                                                            <!-- ... add more fields if needed ... -->

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
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row-->


    </div> <!-- container -->

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Edit Button click handler
            $('.edit-button').on('click', function() {
                var id = $(this).data('id');
                var url = "{{ route('subscriptions.edit', ':id') }}";
                url = url.replace(':id', id);

                // Set the form action URL dynamically
                $('#editForm').attr('action', url);
            });
        });
    </script>
@endsection
