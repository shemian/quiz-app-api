@extends('layouts.master')

@section('content')


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
        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Customers</h5>
                            <h3 class="my-2 py-1">{{ $customerCount }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 3.27%</span>
                            </p>
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

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Students</h5>
                            <h3 class="my-2 py-1">{{ $studentCount  }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 5.38%</span>
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

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Deals">Teachers</h5>
                            <h3 class="my-2 py-1">{{ $teacherCount  }}</h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 4.87%</span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="deals-chart" data-colors="#727cf5"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Revenue</h5>
{{--                            <h3 class="my-2 py-1">ksh {{ $organization_revenue }}</h3>--}}
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 11.7%</span>
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

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-1">SMS</h4>

                    <div id="dash-campaigns-chart" class="apex-charts" data-colors="#ffbc00,#727cf5,#0acf97"></div>

                    <div class="row text-center mt-2">
                        <div class="col-md-4">
                            <i class="mdi mdi-send widget-icon rounded-circle bg-light-lighten text-muted"></i>
                            <h3 class="fw-normal mt-3">
                                <span>6,510</span>
                            </h3>
                            <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-warning"></i> Total Sent</p>
                        </div>
                        <div class="col-md-4">
                            <i class="mdi mdi-flag-variant widget-icon rounded-circle bg-light-lighten text-muted"></i>
                            <h3 class="fw-normal mt-3">
                                <span>3,487</span>
                            </h3>
                            <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-primary"></i> Delivered</p>
                        </div>
                        <div class="col-md-4">
                            <i class="mdi mdi-email-open widget-icon rounded-circle bg-light-lighten text-muted"></i>
                            <h3 class="fw-normal mt-3">
                                <span>1,568</span>
                            </h3>
                            <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> Pending</p>
                        </div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->

        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last Week</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                        </div>
                    </div>

                    <h4 class="header-title mb-3">Revenue</h4>

                    <div class="chart-content-bg">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <p class="text-muted mb-0 mt-3">Escrow Balance</p>
                                <h2 class="fw-normal mb-3">
                                    <span>ksh {{ $totalCentyBalance }}</span>
                                </h2>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-0 mt-3">Student's Balance</p>
                                <h2 class="fw-normal mb-3">
                                    <span>ksh {{ $totalWalletBalance }}</span>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div dir="ltr">
                        <div id="dash-revenue-chart" class="apex-charts" data-colors="#0acf97,#fa5c7c"></div>
                    </div>

                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col-->
    </div>
    <!-- end row-->


    <div class="row">
        <div class="col-xl-6 col-lg-">
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
                    <h4 class="header-title mb-3">Top Performing Students</h4>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Students</th>
                                    <th>Centys</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($topStudensts as $topStudenst)
                                <tr>
                                    <td>
                                        <span class="badge badge-success-lighten float-end">Won lead</span>
                                        <h5 class="mt-0 mb-1">{{ $topStudenst->student->user->name }}</h5>
                                        <span class="text-muted font-13">{{ $topStudenst->student->educationLevel->name}}, {{$topStudenst->student->school_name}}</span>
                                    </td>
                                    <td>{{ $topStudenst->yes_ans}}</td>
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

        <div class="col-xl-6 col-lg-6">
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
                    <h4 class="header-title mb-4">Recent Clients</h4>
                    @foreach ($latestCustomers as $customer)
                    <div class="d-flex align-items-start">
                        <img class="me-3 rounded-circle" src="{{ asset('assets/images/users/avatar-2.jpg') }}" width="40" alt="Generic placeholder image">
                        <div class="w-100 overflow-hidden">
                            <h5 class="mt-0 mb-1">{{ $customer->name }}</h5>
                            <span class="font-13">{{ $customer->email }}</span>
                        </div>
                    </div>
                    @endforeach


                </div>
                <!-- end card-body -->
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->

    </div>
    <!-- end row-->

</div>

@endsection
