@extends('Educator.layout')
@section('title', 'Home')



@section('content')
<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/Educator/home.css">
	
</head>
<body>

	@if(Session::has('success'))
		<div class="alert alert-success" style="width: 30%; text-align: center; padding: 1px; position: relative; left: 30%; top:30%; margin-top: 12px; z-index: 3;">{{Session::get('success')}}</div>
	@elseif(Session::has('fail'))
		<div class="alert alert-danger" style="width: 30%; text-align: center; padding: 1px; position: relative; left: 30%; top:30%; margin-top: 12px;">{{Session::get('fail')}}</div>
	@endif

	<!-- course Card -->

	<div class="container-body">

		@if($course->count() >0)		
			<div class="row">
				@foreach ($course as $courseitem)
					<div class="card card-size" style="width: 18rem;">
						@if($courseitem->publishCourse == 1)
							<span style=" position: absolute;right:12px; background-color: rgb(47, 197, 47); margin-top: 5px; font-weight: 200">LIVE</span>	
						@elseif($courseitem->publishCourse == 0)
							<span style="text-align: right; position: absolute;right:12px; background-color: rgb(45, 199, 204); margin-top: 5px; font-weight: 200">PENDING</span>
						@elseif($courseitem->publishCourse == 3)
							<span style="text-align: right; position: absolute;right:12px; background-color: rgb(204, 45, 45); margin-top: 5px; font-weight: 200">REJECTED</span>
						@endif
						
						<img src="{{$courseitem->courseThumbnile}}" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title">{{$courseitem->courseName}}</h5>
							<p class="card-text">{{$courseitem->courseDescription}}</p>
							<h3 style="text-align: right; color: darkorange">{{$courseitem->coursePrice}}$</h3>
							{{-- <a href="{{url('course-view/'.$courseitem->id)}}" class="btn btn-primary">Edit Course</a> --}}
							<a href="{{route('course-view')}}?id={{$courseitem->id}}" class="btn btn-primary">Edit Course</a>
							
						</div>
					</div>
				@endforeach
	
			</div>
		@else
		<div style=" text-align: center; position: absolute; top:150px; left: 420px">
			<i class="fa-solid fa-school-circle-exclamation fa-2xl"></i><br>
			
				<b>No Courses Yet</b><br>
				Start your career with Course mate
			
		</div>
		@endif
		
		
	</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

@endsection
