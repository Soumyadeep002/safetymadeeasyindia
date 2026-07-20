@extends('admin.layout.main')
@section('main-container')
@php
use Illuminate\Support\Str;
@endphp

<!-- Page header start -->
<div class="page-header">
    <!-- Breadcrumb start -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Blogs</li>
    </ol>
    <!-- Breadcrumb end -->

        <!-- App actions start -->
        <ul class="app-actions">
            <li>
                <a href="{{url('admin/alter-blogs/0')}}">
                    <i class="icon-export"></i> Add New
                </a>
            </li>
        </ul>
        <!-- App actions end -->


</div>
<!-- Page header end -->

<!-- Row start -->
    <div class="row gutters">

        @forelse ($blogs as $blog)
            <div class="card col-xl-3 col-md-6 col-sm-4 col-12">
                <img class="card-img-top" src="{{url('/myfile/'.$blog->image1)}}" alt="Admin Dashboards">
                <div class="card-body">
                    <h5 class="card-title">{{$blog->blog_title}}</h5>
                    <h5>Author: {{ explode(' ', $blog->author)[0] }}</h5>
                    <h5>Category: {{ $blog->category->category_title}}</h5>
                    <p class="disc">{{Str::limit(strip_tags($blog->blog_para_1), 160, '...')}}</p>
                    <a href="{{url('admin/alter-blogs'.'/'.$blog->id)}}" class="btn btn-primary">Edit</a>
                    {{-- <a href="" class="btn btn-secondary">Publish</a> --}}
                    @if ($blog->status=='published')
                        <a href="{{url('admin/update-status'.'/'.$blog->id)}}" class="btn btn-danger">Archive</a>
                    @else
                        <a href="{{url('admin/update-status'.'/'.$blog->id)}}" class="btn btn-secondary">Publish</a>
                    @endif
                    <p class="card-text">
                        <small class="text-muted">Last updated {{ \Carbon\Carbon::parse($blog->updated_at)->diffForHumans() }}</small>
                    </p>
                </div>
            </div>
        @empty
            <h3>No Blogs Found</h3>
        @endforelse

    </div>

@endsection
