@extends('backend.partials.master')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-10 title">
			<h1><i class="fa fa-bars"></i> Add New Post</h1>
		</div>

		<div class="col-sm-12">
            @include('backend.partials.messages')

			<div class="row">
				<form  action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-9">
						<div class="form-group">
							<input type="text" name="post_title" id="post_title" class="form-control" placeholder="Enter title here">
						</div>
                        <div class="form-group">
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter Slug">
                        </div>
						<div class="form-group">
							<textarea class="form-control" name="description" rows="15"></textarea>
							<div class="col-sm-12 word-count">Word count: 0</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="content publish-box">
							<h4>Publish  <span class="pull-right"><i class="fa fa-chevron-down"></i></span></h4><hr>
							<div class="form-group">
								<button class="btn btn-default" name="status" value="draft">Save Draft</button>
							</div>
							<p>Status: Draft <a href="#">Edit</a></p>
							<p>Visibility: Public <a href="#">Edit</a></p>
							<p>Publish: Immediately <a href="#">Edit</a></p>
							<div class="row">
								<div class="col-sm-12 main-button">
									<button class="btn btn-primary pull-right" name="status" value="publish">Publish</button>
								</div>
							</div>
						</div>

						<div class="content cat-content">
                            <h4>Category  <span class="pull-right"><i class="fa fa-chevron-down"></i></span></h4><hr>
                            @foreach ($categories as $category)
                        <p><label for="{{$category->id}}"><input type="checkbox" name="category_id[]" value="{{ $category->id }}">{{$category->category_name}}</label></p>
							 @endforeach

						</div>
						<div class="content featured-image">
							 <p><input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)"
                                style="display: none;"></p>
                                  <p><img id="output" width="200" /></p>
                        <p><label for="file" class="" style="cursor: pointer;">Set Featured Image</label></p>


						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function(){
		$('.fa-bars').click(function(){
			$('.sidebar').toggle();
		})
	});
</script>
<script src="{{asset('ckeditor/ckeditor/ckeditor.js')}}"></script>
<script>
	CKEDITOR.replace('description', { "filebrowserBrowseUrl": "/ckeditor\/ckfinder\/ckfinder.html", "filebrowserImageBrowseUrl": "/ckeditor\/ckfinder\/ckfinder.html?type=Images", "filebrowserFlashBrowseUrl": "/ckeditor\/ckfinder\/ckfinder.html?type=Flash", "filebrowserUploadUrl": "/ckeditor\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Files", "filebrowserImageUploadUrl": "/ckeditor\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Images", "filebrowserFlashUploadUrl": "/ckeditor\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Flash" });
</script>

<script>
    var loadFile = function (event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

</script>
@endsection
