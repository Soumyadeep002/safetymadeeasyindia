@extends('admin.layout.main')
@section('main-container')

<!-- Page header start -->
<div class="page-header">
    <!-- Breadcrumb start -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Edit Blog
            @isset($blog)
                {{$blog->blog_title}}
            @endisset
        </li>
    </ol>
    <!-- Breadcrumb end -->

        <!-- App actions start -->
        <ul class="app-actions">
            {{-- <li>
                <a href="">
                    <i class="icon-import"></i> Back
                </a>
            </li> --}}
        </ul>
        <!-- App actions end -->


</div>
<!-- Page header end -->
					<!-- Row start -->
					<div class="row gutters">

                        <div class="col-sm-12">
                                <form action="{{url($post_url)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row gutters">
                                            <div class="col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="inputName" style="font-size: 1rem">Blog Title</label>
                                                    <input type="text" value="{{ old('title', $blog->blog_title ?? '') }}" required class="form-control form-control-lg" id="inputName" name="title" placeholder="Enter Blog Title">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="author" style="font-size: 1rem">Blog Author</label>
                                                    <input type="text" required class="form-control form-control-lg" value="{{ old('author', $blog->author ?? '') }}" id="author" name="author" placeholder="Enter Author Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="category" style="font-size: 1rem">Blog Category</label>
                                                    <select id="category" name="category" class="form-control form-control-lg">
                                                        <option>Please Select</option>
                                                        @foreach ($categories as $cat)
                                                            <option  value="{{$cat->id}}" {{ isset($blog) && $blog->category_id == $cat->id ? 'selected' : '' }}>{{$cat->category_title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        @if(session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <div class="card m-0">
                                    <div class="card-header">
                                        <div class="card-title">Write Content</div>
                                    </div>
                                    <div class="card-body">
                                        <textarea name="content" class="summernote">{{ isset($blog) ? $blog->blog_para_1 : '' }}</textarea>
                                        <a href="{{route('adminblogs')}}" class="btn btn-secondary">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                    </div>
                                </div>
                            </div>


                        <div class="col-sm-12 mt-3">
							<div class="card">
                                <div class="card-header">
									<div class="card-title">Upload Images</div>
								</div>
								<div class="card-body">
									<div class="row gutters">
										<div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                            @if(isset($blog->image1))
                                                <img src="{{url('/myfile/'.$blog->image1)}}" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image1" width="400" alt="Preview">
                                                @else
                                                <img src="" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image1" width="400" alt="Preview">
                                            @endif
											<div class="form-group">
												<div class="custom-file">
                                                    <input type="file" id="fileInput1" class="custom-file-input" name="image1" id="image1"
                                                        aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="image1">Thumbnail Image (size: 306 x 260, 2MB Max)</label>
                                                </div>

                                                @error('image1')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
											</div>
										</div>
										<div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                            @if(isset($blog->image2))
                                            <img src="{{url('/myfile/'.$blog->image2)}}" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image2" width="400" alt="Preview">
                                            @else
                                            <img src="" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image2" width="400" alt="Preview">
                                            @endif
											<div class="form-group">
												<div class="custom-file">
                                                    <input type="file" id="fileInput2" class="custom-file-input" name="image2" id="image2"
                                                        aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="image2">Image 1 (size: 1600 x 960, 2MB Max)</label>
                                                </div>
                                                @error('image2')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
											</div>
										</div>
										<div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                            @if(isset($blog->image3))
                                            <img src="{{url('/myfile/'.$blog->image3)}}" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image3" width="400" alt="Preview">
                                            @else
                                            <img src="" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image3" width="400" alt="Preview">
                                            @endif
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="fileInput3" class="custom-file-input" name="image3" id="image3"
                                                        aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="image3">Image 2 (size: 1600 x 960, 2MB Max)</label>
                                                </div>
                                                @error('image3')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
											</div>
										</div>
										<div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                            @if(isset($blog->image4))
                                            <img src="{{url('/myfile/'.$blog->image4)}}" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image4" width="400" alt="Preview">
                                            @else
                                            <img src="" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image4" width="400" alt="Preview">
                                            @endif
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="fileInput4" class="custom-file-input" name="image4" id="image4"
                                                        aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="image4">Image 3 (size: 1600 x 960, 2MB Max)</label>
                                                </div>
                                                @error('image4')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
											</div>
										</div>
										<div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                            @if(isset($blog->image5))
                                            <img src="{{url('/myfile/'.$blog->image5)}}" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image5" width="400" alt="Preview">
                                            @else
                                            <img src="" style="margin-bottom: 15px; border: 2px solid black; padding: 5px 5px 5px 5px;" id="image5" width="400" alt="Preview">
                                            @endif
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" id="fileInput5" class="custom-file-input" name="image5" id="image5"
                                                        aria-describedby="inputGroupFileAddon01">
                                                    <label class="custom-file-label" for="image5">Image 4 (size: 1600 x 960, 2MB Max)</label>
                                                </div>
                                                @error('image5')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
											</div>
										</div>

									</div>

                                    <a href="{{route('adminblogs')}}" class="btn btn-secondary">Cancel</a>
									<button class="btn btn-primary" type="submit">Upload Images</button>
                                    </form>
								</div>
							</div>
						</div>

					</div>
					<!-- Row end -->

                    <script>
                        document.getElementById('fileInput1').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.getElementById('image1');
                                    img.src = e.target.result;
                                    img.style.display = 'block';
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                        document.getElementById('fileInput2').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.getElementById('image2');
                                    img.src = e.target.result;
                                    img.style.display = 'block';
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                        document.getElementById('fileInput3').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.getElementById('image3');
                                    img.src = e.target.result;
                                    img.style.display = 'block';
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                        document.getElementById('fileInput4').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.getElementById('image4');
                                    img.src = e.target.result;
                                    img.style.display = 'block';
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                        document.getElementById('fileInput5').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.getElementById('image5');
                                    img.src = e.target.result;
                                    img.style.display = 'block';
                                }
                                reader.readAsDataURL(file);
                            }
                        });



                        document.getElementById("fileInput1").addEventListener("change", function (event) {
                        const file = event.target.files[0];
                        if (!file) return;

                        const img = new Image();
                        const objectURL = URL.createObjectURL(file);

                        img.onload = function () {
                            // Define required width & height
                            const requiredWidth = 306;
                            const requiredHeight = 260;

                            if (img.width !== requiredWidth || img.height !== requiredHeight) {
                                // Show error, add class
                                event.target.classList.add("is-invalid");
                            } else {
                                event.target.classList.remove("is-invalid");
                            }

                            // Release memory
                            URL.revokeObjectURL(objectURL);
                        };

                        img.src = objectURL;
                    });


                        document.getElementById("fileInput2").addEventListener("change", function (event) {
                        const file = event.target.files[0];
                        if (!file) return;

                        const img = new Image();
                        const objectURL = URL.createObjectURL(file);

                        img.onload = function () {
                            // Define required width & height
                            const requiredWidth = 1600;
                            const requiredHeight = 960;

                            if (img.width !== requiredWidth || img.height !== requiredHeight) {
                                // Show error, add class
                                event.target.classList.add("is-invalid");
                            } else {
                                event.target.classList.remove("is-invalid");
                            }

                            // Release memory
                            URL.revokeObjectURL(objectURL);
                        };

                        img.src = objectURL;
                    });


                        document.getElementById("fileInput3").addEventListener("change", function (event) {
                        const file = event.target.files[0];
                        if (!file) return;

                        const img = new Image();
                        const objectURL = URL.createObjectURL(file);

                        img.onload = function () {
                            // Define required width & height
                            const requiredWidth = 1600;
                            const requiredHeight = 960;

                            if (img.width !== requiredWidth || img.height !== requiredHeight) {
                                // Show error, add class
                                event.target.classList.add("is-invalid");
                            } else {
                                event.target.classList.remove("is-invalid");
                            }

                            // Release memory
                            URL.revokeObjectURL(objectURL);
                        };

                        img.src = objectURL;
                    });


                        document.getElementById("fileInput4").addEventListener("change", function (event) {
                        const file = event.target.files[0];
                        if (!file) return;

                        const img = new Image();
                        const objectURL = URL.createObjectURL(file);

                        img.onload = function () {
                            // Define required width & height
                            const requiredWidth = 1600;
                            const requiredHeight = 960;

                            if (img.width !== requiredWidth || img.height !== requiredHeight) {
                                // Show error, add class
                                event.target.classList.add("is-invalid");
                            } else {
                                event.target.classList.remove("is-invalid");
                            }

                            // Release memory
                            URL.revokeObjectURL(objectURL);
                        };

                        img.src = objectURL;
                    });


                        document.getElementById("fileInput5").addEventListener("change", function (event) {
                        const file = event.target.files[0];
                        if (!file) return;

                        const img = new Image();
                        const objectURL = URL.createObjectURL(file);

                        img.onload = function () {
                            // Define required width & height
                            const requiredWidth = 1600;
                            const requiredHeight = 960;

                            if (img.width !== requiredWidth || img.height !== requiredHeight) {
                                // Show error, add class
                                event.target.classList.add("is-invalid");

                            } else {
                                event.target.classList.remove("is-invalid");
                            }

                            // Release memory
                            URL.revokeObjectURL(objectURL);
                        };

                        img.src = objectURL;
                    });


                    </script>

@endsection
