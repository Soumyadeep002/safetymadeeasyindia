@extends('admin.layout.main')
@section('main-container')

<!-- Page header start -->
<div class="page-header">
    <!-- Breadcrumb start -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
    </ol>
    <!-- Breadcrumb end -->

    <!-- App actions start -->
    <ul class="app-actions">
        <li>
            <a href="#">
                <i class="icon-export"></i> Export
            </a>
        </li>
    </ul>
    <!-- App actions end -->
</div>
<!-- Page header end -->

    <!-- Row start -->
    <div class="row gutters">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-book"></i>
                </div>
                <div class="sale-num">
                    <h2>{{$courseCount}}</h2>
                    <p>Training Programs</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-book-open"></i>
                </div>
                <div class="sale-num">
                    <h2>{{$blogCount}}</h2>
                    <p>Blogs Published</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-contact_mail"></i>
                </div>
                <div class="sale-num">
                    <h2>{{$enrolled}}</h2>
                    <p>Enrollments</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-message"></i>
                </div>
                <div class="sale-num">
                    <h2>{{$messages}}</h2>
                    <p>Messages</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-book"></i>
                </div>
                <div class="sale-num">
                    <h2>{{ $bookCount }}</h2>
                    <p>Books</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="info-stats2">
                <div class="info-icon">
                    <i class="icon-cart"></i>
                </div>
                <div class="sale-num">
                    <h2>{{ $bookSales }}</h2>
                    <p>Book Sales</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Row end -->

@endsection
