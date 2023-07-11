@extends('Educator.layout')
@section('title', 'Profile')



@section('content')
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}
	
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}

	<link rel="stylesheet" type="text/css" href="css/Educator/profile.css">
</head>
<body>
	
	
	<!-- header -->
	<div class="container-cover">
		<img src="{{ $data->educatorCoverImage == '' ? 'images/cover/cover1.jpg' : $data->educatorCoverImage}}" class="cover-image" title="cover image size is 1350px X 140px">
	</div>
	
	<div class="container-profile-image">
		<img src="{{ $data->educatorProfileImage == '' ? 'images/profile.png' : $data->educatorProfileImage}}" class="pro-image">
	</div>

	<div class="container-user-name">
		<strong><b>{{$data->educatorName}} </b></strong><br>
		{{$data->educatorEmail}} 
	</div>

	

	<!-- body -->
	@if(Session::has('success'))
		<div class="alert alert-success" style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 25%; top:30%; margin-top: 12px;">{{Session::get('success')}}</div>
	@elseif(Session::has('fail'))
		<div class="alert alert-danger" style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 25%; top:30%; margin-top: 12px;">{{Session::get('fail')}}</div>
	@endif
	
		
	<div class="container-body">
		<form action="{{route('update-profile')}}" method="post" enctype="multipart/form-data">
			@csrf
			@method('PUT')

		  <div class="form-row">
		    <div class="form-group col-md-4">
		      <label for="inputName">Full Name</label>
		      <input type="text" class="form-control" id="inputName" name="name" placeholder="Full Name" value="{{$data->educatorName}}">
		    </div>
		    <div class="form-group col-md-4">
		      <label for="inputEmail">Email</label>
		      <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email Address" value="{{$data->educatorEmail}} ">
		    </div>
		  </div>

		  <div class="form-row">
		  	<div class="form-group col-md-4">
		      <label for="inputPassword">Password</label>
		      <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
		    </div>

		  </div>
		  
		  <div class="form-row">
		      <div class="form-group col-md-8">
			    	<label for="Bio">Bio</label>
			    	<textarea class="form-control" id="Bio" name="bio" rows="3" >{{$data->educatorBio}} </textarea>
		      </div>
		  </div>

		  <div class="form-row">
			<div class="form-group">
				<label for="ProfilePicture">Profile Picture</label>
				<input type="file" class="form-control-file" accept="image/png, image/jpg, image/jpeg" id="ProfilePicture" name="profile">
			</div>
		
			<div class="form-group">
				<label for="CoverPicture">Cover Picture</label>
				<input type="file" class="form-control-file" accept="image/png, image/jpg, image/jpeg" id="CoverPicture" name="cover" >
			</div>
		  </div>
		  
		  <input type="hidden" name="id" value="{{$data->id}}">
		  <button type="submit" class="btn btn-primary btnsave" style="background-color: rgb(32,56,100);">Save</button>

		</form>
	</div>

	<div class="container-about">
		<h5>About Me</h5>
		<p style="text-align: justify;">
			{{$data->educatorBio}}
		</p>
	</div>


{{-- 
	<script>
		

		if('{{$data->educatorCoverImage}}' != ''){
			// Get a reference to our file input
			const coverfileInput = document.querySelector('input[id="CoverPicture"]');
			// Create a new File object of cover
			const myFileCover = new File(['current Cover photo'], '{{$data->educatorCoverImage}}', {
			type: 'image',
			lastModified: new Date(),
			});
	
			// Now let's create a DataTransfer to get a FileList
			const dataTransferCover = new DataTransfer();
			dataTransferCover.items.add(myFileCover);
			coverfileInput.files = dataTransferCover.files;
		}
		

		if('{{$data->educatorProfileImage}}' != ''){
			const profilefileInput = document.querySelector('input[id="ProfilePicture"]');
			// Create a new File object of profile
			const myFileProfile = new File(['current Cover photo'],'{{$data->educatorProfileImage}}' , {
				type: 'image',
				lastModified: new Date(),
			});
		
			// Now let's create a DataTransfer to get a FileList
			const dataTransferProfile = new DataTransfer();
			dataTransferProfile.items.add(myFileProfile);
			profilefileInput.files = dataTransferProfile.files;
		}
	</script> --}}


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
@endsection