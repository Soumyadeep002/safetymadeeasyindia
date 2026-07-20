@extends('admin.layout.main')
@section('main-container')

<!-- Page header start -->
<div class="page-header">
    <!-- Breadcrumb start -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Blog Categories</li>
    </ol>
    <!-- Breadcrumb end -->



</div>
<!-- Page header end -->

<!-- Row start -->

    <div class="row gutters">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                <form action="{{url('admin/add-blog-categories')}}" method="post">
                    @csrf
                    <div class="row gutters">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputName">Category Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter category title">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row gutters">
        <div class="col-sm-12">
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table custom-table m-0">
                        <thead>
                            <tr>
                                <th>Category ID.</th>
                                <th>Category Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cats as $cat)
                                <tr>
                                    <td>#{{$cat->id}}</td>
                                    <td>{{$cat->category_title}}</td>

                                </tr>
                            @empty
                            <td colspan="2" class="text-center text-muted">No Category found</td>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection
