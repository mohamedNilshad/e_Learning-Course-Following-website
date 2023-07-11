<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Educator Registration</title>
   <link rel="stylesheet" href="style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Educator/reg_style.css') }}" />

</head>


<body>
	@if(Session::has('success'))
	<div class="alert alert-success" style="width: 58%; text-align: center; padding: 1px;">{{Session::get('success')}}</div>
@endif

@if(Session::has('fail'))
	<div class="alert alert-danger" style="width: 58%; text-align: center; padding: 1px;">{{Session::get('fail')}}</div>
@endif

<div class="container" id="container">
			
	
	<div class="form-container sign-in-container">
		
		<form action="{{route('register-educator')}}" method="post">
			
			@csrf
			<h4>Welcome</h4>
			<p> Experience education like never before
                with our online teaching platform.</p>
			<label style="text-align: start; font-size: 12px; color: black; font-weight: 550;"> Name: </label>
			<input type="text" placeholder="Name" name="name" value="{{old('name')}}"/>
			<span class="text-danger" style="font-size: 12px; text-align: start;">@error('name') {{$message}} @enderror</span>

			<label style="text-align: start; font-size: 12px; color: black; font-weight: 550;"> Email: </label>
			<input type="email" placeholder="Email" name="email" value="{{old('email')}}" />
			<span class="text-danger" style="font-size: 12px; text-align: start;">@error('email') {{$message}} @enderror</span>

			<label style="text-align: start; font-size: 12px; color: black; font-weight: 550;"> Password: </label>
			<input type="password" placeholder="Password" name="password" value="{{old('password')}}"/>
			<span class="text-danger" style="font-size: 12px; text-align: start;">@error('password') {{$message}} @enderror</span>

			<button>Sign Up</button>
				
			<p><b> Already have an account ? <a href="login" style="color:blue; font-weight: 1000"> Sign In</a></b></p>

		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<img src="{{ asset('images/clipart1.jpg') }}" alt="Online Education" width="122%" height="97%" style="border-radius: 15px">
			</div>
		</div>
	</div>
</div>

 
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>