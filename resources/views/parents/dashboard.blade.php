@extends('parents.master')

@section('content')

<div class="content">


    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Students</h5>
                                <h3 class="my-2 py-1">{{ count($students) }}</h3>
                                <a href="{{ route('get_students') }}" target="_blank">Add a Student</a>

                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <div id="campaign-sent-chart" data-colors="#727cf5"></div>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Wallet Balance</h5>
                                <h3 class="my-2 py-1">Ksh 0.00</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><a href="" target="_blank">Deposit Funds</a></span>
                                </p>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <div id="new-leads-chart" data-colors="#0acf97"></div>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->



            <div class="col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Plan</h5>
                                <h3 class="my-2 py-1">Monthly</h3>
                                <p class="mb-0 text-muted">
                                    <span class="text-success me-2"><a href="" target="_blank">Renew Plan</a></span>
                                </p>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <div id="booked-revenue-chart" data-colors="#0acf97"></div>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
        <!-- end row-->


        <div class="row">
            <div class="col-xl-12 col-lg-">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>
                        <h4 class="header-title mb-3">My Students</h4>

                        <div class="table-responsive">
                            <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>Students</th>
                                        <th>Centiis</th>
                                        <th>Average Score</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>
                                            <h5 class="font-15 mb-1 fw-normal">{{ $student->user->name }}</h5>
                                            <span class="text-muted font-13">{{ $student->school_name }}</span>
                                        </td>
                                        <td>{{ $student->credit }}</td>
                                        <td> </td>
                                        <td class="table-action">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach




                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            <!-- end col-->

        </div>
        <!-- end row-->
    </div>
    <!-- container -->
</div>

@endsection
