@extends('admin.layout.main')
@section('main-container')

<!-- Page header start -->
<div class="page-header">
    <!-- Breadcrumb start -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Messages</li>
    </ol>
    <!-- Breadcrumb end -->



</div>
<!-- Page header end -->

<!-- Row start -->
    <div class="row gutters">
        <div class="col-sm-12">

            <div class="table-container">
                <div class="t-header">New Messages</div>
                <div class="table-responsive">
                    <table id="copy-print-csv" class="table custom-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($msgs as $msg)
                                <tr>
                                    <td>{{$msg->created_at}}</td>
                                    <td>{{$msg->name}}</td>
                                    <td>{{$msg->email}}</td>
                                    <td>{{$msg->message}}</td>

                                </tr>
                            @empty
                                <td colspan="4" class="text-center text-muted">No messages found</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
@endsection
