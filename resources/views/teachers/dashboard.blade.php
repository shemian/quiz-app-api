@extends('teachers.master')

@section('content')

<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>     <!-- end page title -->

    <div class="row">
        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Campaign Sent">Exams</h5>
                            <h3 class="my-2 py-1">{{ $exam_count }}</h3>
{{--                            <p class="mb-0 text-muted">--}}
{{--                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 3.27%</span>--}}
{{--                            </p>--}}
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
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">Subjects</h5>
                            <h3 class="my-2 py-1">{{ $subject_count }}</h3>
{{--                            <p class="mb-0 text-muted">--}}
{{--                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 5.38%</span>--}}
{{--                            </p>--}}
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
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Booked Revenue">Questions</h5>
                            <h3 class="my-2 py-1">{{  $questionCount  }}</h3>
{{--                            <p class="mb-0 text-muted">--}}
{{--                                <span class="text-success me-2"><i class="mdi mdi-arrow-up-bold"></i> 3.27%</span>--}}
{{--                            </p>--}}
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

        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="New Leads">My Classes</h5>
                            <h3 class="my-2 py-1">0</h3>
                            {{--                            <p class="mb-0 text-muted">--}}
                            {{--                                <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 5.38%</span>--}}
                            {{--                            </p>--}}
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
    </div>

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
                    <h4 class="header-title mb-3">Exams</h4>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Exam Name</th>
                                    <th>Subject</th>
                                    <th>No Questions</th>
                                    <th>No Topics</th>
                                    <th>No Subtopics</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">{{ $exam->name}}</h5>
                                        <span class="text-muted font-13">{{ $exam->subject->educationSystem->name}}, {{ $exam->subject->educationLevel->name}}</span>
                                    </td>
                                    <td>{{ $exam->subject->name }}</td>
                                    <td>{{ $exam->questions_count  }}</td>
                                    <td>{{ $topics_subtopics_counts[$exam->id]["topicStrands"] }}</td>
                                    <td>{{ $topics_subtopics_counts[$exam->id]["subTopicStrands"]  }}</td>

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

@endsection
