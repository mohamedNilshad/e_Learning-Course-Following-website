@extends('Educator.layout')
@section('title', 'Edit Course')

@section('content')


<!DOCTYPE html>
<html>
    <head>
        <title></title>
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="css/Educator/create_new.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    </head>
    <style>
        .sel:hover{
            background-color: lavender;
        }
    </style>
<body>

	
  @if(Session::has('success'))
    <div class="alert alert-success" style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 30%; top:28%; margin-top: 12px;">{{Session::get('success')}}</div>
  @elseif(Session::has('fail'))
    <div class="alert alert-danger" style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 30%; top:28%; margin-top: 12px;">{{Session::get('fail')}}</div>
  @endif

	<!-- body -->
    
	    <div class="container-body">
            <div id="multi-step-form-container">
                <!-- Step Wise Form Content -->
                <form  action="{{route('add-new-video')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                     <!-- Step 2 Content, default hidden on page load. -->
                    <section id="step-2" class="form-step">
                        <h2 class="font-normal">Course Materials</h2>
                        <p>Upload Your Course videos and it's materials one by one</p><hr style="height:2px;border:none;color:#333;background-color:#333;"><br>
                        <!-- Step 2 input fields -->
                        <!-- for add another video -->
                        <div class="input_fields_wrap_video">
                        <div class="mt-3">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="inputPassword">Upload Video 1</label>
                                    <input type="hidden" name="crsID" value="{{$course->id}}">
                                    <input type="file" class="form-control-file" accept="video/*"  id="inputProfile" name="course_video[]" required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                <label for="inputName">Video Title</label>
                                <input type="text" class="form-control" id="inputName" name="video_title[]" placeholder="Video Title" required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="description">Video Description</label>
                                    <textarea class="form-control" id="course_description" name="video_description[]" rows="3" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                <label for="inputPassword">Upload Video Thumbnile</label>
                                    <div class="input_fields_wrap">
                                        <input type="file" class="form-control-file" accept="image/*"  id="inputProfile" name="video_thumb[]"  style="margin-bottom: 15px;" multiple="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="inputPassword">Upload Documents</label>
                                    <div class="input_fields_wrap">
                                        <input type="file" class="form-control-file"  id="inputProfile" name="video_document0[]"  style="margin-bottom: 15px;" multiple="">
                                    </div>
                                </div>
                            </div>
                        </div>  
                        </div>
                        <button class="add_field_button_video">Add Another Video</button>

                        <div class="mt-3">
                            <button class="button submit-btn" type="submit" name="saveData">Save</button>
                        </div>
                    </section>
                    
                </form>
            </div>
	    </div>
        <div class="nav-btn">
            <div class="card" style="width: 11rem;">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item sel"><a href="{{route('edit-course')}}?cid={{$course->id}}">Course Details</a></li>
                  <li class="list-group-item sel"><a href="{{route('edit-videos')}}?cid={{$course->id}}">Course Videos</a></li>
                  <li class="list-group-item sel" style="background-color: lightsteelblue" ><a href="{{route('add-videos')}}?cid={{$course->id}}">Add New Videos</a></li>
                </ul>
            </div>
        </div>

  


<!-- for add new video section -->

<script type="text/javascript" src="js/Educator/create_new.js"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>



@endsection