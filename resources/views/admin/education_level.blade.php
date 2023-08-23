@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Education System</a></li>
                        </ol>
                    </div>
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add Education Level
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

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add Education System</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            @csrf

                            <div class="form-group">
                                <label for="education_system_id">Education System</label>
                                <select id="education_system_id" name="education_system_id" class="form-control">
                                    <option value="">Select Education System</option>
                                    @foreach ($education_systems as $education_system)
                                        <option value="{{ $education_system->id }}">{{ $education_system->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control" name="name" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Education Level</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($education_systems as $education_system)
                <div class="col-md-6 col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $education_system->name }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($education_levels as $education_level)
                                    @if ($education_level->education_system_id === $education_system->id)
                                        <li class="list-group-item">{{ $education_level->name }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
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
