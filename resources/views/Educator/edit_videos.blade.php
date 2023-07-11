@extends('Educator.layout')
@section('title', 'Edit Course')

@section('content')


    <!DOCTYPE html>
    <html>

    <head>
        <title></title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <link href="css/Educator/create_new.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <style>
        .sel:hover {
            background-color: lavender;
        }
    </style>

    <body>




        <!-- body -->

        <div class="container-body">
            <div id="multi-step-form-container">
                <!-- Step Wise Form Content -->

                <!-- Step 2 Content, default hidden on page load. -->
                <section id="step-1" class="form-step">
                    <h2 class="font-normal">Course Video Materials</h2>
                    <p>Update Your Course videos here</p>
                    <hr style="height:2px;border:none;color:#333;background-color:#333;"><br>
                    <!-- Step 2 input fields -->

                    <div class="input_fields_wrap_video">
                        @php
                            $vCount = 1;
                        @endphp
                        @foreach ($video as $video_item)
                            <form action="{{ route('update-video') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mt-3">
                                    <div class="form-row">

                                        <video src="{{ $video_item->video_url }}" width="25%"></video>
                                        <div class="form-group col-md-8">
                                            <label for="inputPassword">Upload Video {{ $vCount }} </label>
                                            {{-- <input type="hidden" id="vCount" value="{{$vCount}}"> --}}
                                            <input type="hidden" name="vID[]" value="{{ $video_item->id }}">
                                            <input type="file" class="form-control-file" accept="video/*"
                                                id="inputProfile" name="course_video[]"
                                                value="{{ $video_item->video_url }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="inputName">Video Title</label>
                                            <input type="text" class="form-control" id="inputName" name="video_title[]"
                                                placeholder="Video Title" value="{{ $video_item->video_title }}"
                                                required="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="description">Video Description</label>
                                            <textarea class="form-control" id="course_description" name="video_description[]" rows="3" required="">{{ $video_item->video_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <img src="{{ $video_item->video_thumb_url }}"width="15%">

                                        <div class="form-group col-md-8">
                                            <label for="inputPassword">Upload Video Thumbnile</label>
                                            <div class="input_fields_wrap">
                                                <input type="file" class="form-control-file" accept="image/*"
                                                    id="inputProfile" name="video_thumb[]"
                                                    value="{{ $video_item->video_thumb_url }}" style="margin-bottom: 15px;"
                                                    multiple="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    @foreach ($document as $docItem)
                                        @if ($docItem->video_id == $video_item->id)
                                            <embed src="{{ $docItem->doc_url }}" width="220px" height="100px" />
                                            <a href="{{ url('delete-doc/' . $docItem->id) }}"
                                                style="color:#ff0000;">Delete</a>
                                        @endif
                                    @endforeach
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="inputPassword">Upload Documents</label>
                                            <div class="input_fields_wrap">
                                                <input type="file" class="form-control-file" id="inputProfile"
                                                    name="video_document0[]" style="margin-bottom: 15px;" multiple="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="button submit-btn" type="submit" name="saveData"
                                            style="background-color: green; height: 40px; padding: 5px;">Update</button>
                                    </div>
                                    <div style="text-align: end;"><a href="{{ url('delete-video/' . $video_item->id) }}"
                                            style="color:#ff0000;">Delete</a> This Video Section </div>
                                </div>
                                <hr size="5px"
                                    style="border: none; height: 1px; color: #ff0000; background-color: #333;">
                                <div style="text-align: center">Next Video Break</div>
                                <hr size="5px"
                                    style="border: none; height: 1px; color: #ff0000; background-color: #333;">
                                @php
                                    $vCount++;
                                @endphp

                            </form>
                        @endforeach

                    </div>


                    {{-- <button class="add_field_button_video">Add Another Video</button> --}}




                    {{-- <div class="mt-3">
                            <button class="button submit-btn" type="submit" name="saveData">Save</button>
                        </div> --}}
                </section>
            </div>
        </div>
        <div class="nav-btn">
            <div class="card" style="width: 11rem;">
                <ul class="list-group list-group-flush" style="background-color: aqua;">
                    <li class="list-group-item sel"><a href="{{ route('edit-course') }}?cid={{ $course->id }}">Course
                            Details</a></li>
                    <li class="list-group-item sel" style="background-color: lightsteelblue"><a
                            href="{{ route('edit-videos') }}?cid={{ $course->id }}">Course Videos</a></li>
                    <li class="list-group-item sel"><a href="{{ route('add-videos') }}?cid={{ $course->id }}">Add New
                            Videos</a></li>

                </ul>
            </div>
        </div>

        <br>
        @if (Session::has('success'))
            <div class="alert alert-success"
                style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 30%; top:28%; margin-top: 12px;">
                {{ Session::get('success') }}</div>
        @elseif(Session::has('fail'))
            <div class="alert alert-danger"
                style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 30%; top:28%; margin-top: 12px;">
                {{ Session::get('fail') }}</div>
        @endif


        <!-- for add new video section -->

        <script type="text/javascript" src="js/Educator/create_new.js"></script>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>

    </body>

    </html>



@endsection
