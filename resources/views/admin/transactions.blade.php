@extends('layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Centy Plus</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Transactions</a></li>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Manage Transactions</h4>

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
                                        <th>Transaction ID</th>
                                        <th>First Name</th>
                                        <th>MiddleName</th>
                                        <th>LastName</th>
                                        <th>MSISDN</th>
                                        <th>Trans Amount</th>
                                        <th>Account Number</th>
                                        <th>Transaction Type</th>
                                        <th>Transaction Time</th>
                                        <th>Business Short Code</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>

                                            <td>{{ $transaction->trans_id }}</td>
                                            <td>{{ $transaction->first_name }}</td>
                                            <td>{{ $transaction->middle_name }}</td>
                                            <td>{{ $transaction->last_name }}</td>
                                            <td>{{ $transaction->msisdn }}</td>
                                            <td>{{ $transaction->trans_amount }}</td>
                                            <td>{{ $transaction->bill_ref_number }}</td>
                                            <td>{{ $transaction->transaction_type }}</td>
                                            <td>{{ $transaction->trans_time }}</td>
                                            <td>{{ $transaction->business_short_code }}</td>


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


@endsection

