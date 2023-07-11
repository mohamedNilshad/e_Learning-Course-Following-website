@extends('Educator.layout')
@section('title', 'Create Course')



@section('content')


    <!DOCTYPE html>
    <html>

    <head>
        <title></title>
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <link href="css/Educator/create_new.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


    </head>

    <body>



        <!-- body -->
        <div class="container-body">

            <div>
                <div id="multi-step-form-container">
                    <!-- Form Steps / Progress Bar -->
                    <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                        <!-- Step 1 -->
                        <li class="form-stepper-active text-center form-stepper-list" step="1">
                            <a class="mx-2">
                                <span class="form-stepper-circle">
                                    <span>1</span>
                                </span>
                                <div class="label">Course Details</div>
                            </a>
                        </li>
                        <!-- Step 2 -->
                        <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                            <a class="mx-2">
                                <span class="form-stepper-circle text-muted">
                                    <span>2</span>
                                </span>
                                <div class="label text-muted">Course Materials</div>
                            </a>
                        </li>
                        <!-- Step 3 -->
                        <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                            <a class="mx-2">
                                <span class="form-stepper-circle text-muted">
                                    <span>3</span>
                                </span>
                                <div class="label text-muted">Upload</div>
                            </a>
                        </li>
                    </ul>


                    <!-- Step Wise Form Content -->
                    <form action="{{ route('create-new') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Step 1 Content -->
                        <section id="step-1" class="form-step">
                            <h2 class="font-normal">Course Details</h2>
                            <hr style="height:2px;border:none;color:#333;background-color:#333;"><br>
                            <!-- Step 1 input fields -->
                            <div class="mt-3">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputName">Course Title</label>
                                        <input type="text" class="form-control" id="inputName" name="course_title"
                                            placeholder="Course Title" required="">
                                        <input type="hidden" name="eduId" value="{{ $data->id }}">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="description">Course Description</label>
                                        <textarea class="form-control" id="course_description" name="course_description" rows="3" required=""></textarea>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputCategory">Category</label>
                                        <select class="form-control" name="course_category" required="">

                                            @foreach ($topic as $topicItem)
                                                <option value="{{ $topicItem->id }}">{{ $topicItem->topic }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputName">Course Price</label>
                                        <input type="number" class="form-control" id="inputName" name="course_price"
                                            placeholder="Price in $" min="0" required="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputThumbnile">Course Thumbnile</label>
                                        <input type="file" class="form-control-file"
                                            accept="image/png, image/jpg, image/jpeg" id="inputProfile"
                                            name="course_thumbnile">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                            </div>
                        </section>
                        <!-- Step 2 Content, default hidden on page load. -->
                        <section id="step-2" class="form-step d-none">
                            <h2 class="font-normal">Course Materials</h2>
                            <p>Upload Your Course videos and it's materials one by one</p>
                            <hr style="height:2px;border:none;color:#333;background-color:#333;"><br>
                            <!-- Step 2 input fields -->
                            <!-- for add another video -->
                            <div class="input_fields_wrap_video">
                                <div class="mt-3">
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="inputPassword">Upload Video 1</label>
                                            <input type="file" class="form-control-file" accept="video/*"
                                                id="inputProfile" name="course_video[]" required="">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="inputName">Video Title</label>
                                            <input type="text" class="form-control" id="inputName"
                                                name="video_title[]" placeholder="Video Title" required="">
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
                                                <input type="file" class="form-control-file" accept="image/*"
                                                    id="inputProfile" name="video_thumb[]" style="margin-bottom: 15px;"
                                                    multiple="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label for="inputPassword">Upload Documents</label>
                                            <div class="input_fields_wrap">
                                                <input type="file" class="form-control-file" id="inputProfile"
                                                    name="video_document0[]" style="margin-bottom: 15px;" multiple="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="add_field_button_video">Add Another Video</button>

                            <div class="mt-3">
                                <button class="button btn-navigate-form-step" type="button"
                                    step_number="1">Prev</button>
                                <button class="button btn-navigate-form-step" type="button"
                                    step_number="3">Next</button>
                            </div>
                        </section>
                        <!-- Step 3 Content, default hidden on page load. -->
                        <section id="step-3" class="form-step d-none">
                            <h2 class="font-normal">Upload</h2>
                            <!-- Step 3 input fields -->
                            <div class="mt-3">
                                <p>Check All files are correct by clicking Save Button upload Your Course to Course Mate,
                                    and after the admin aprovel your course will publish to people
                                    Thank you!</p>
                            </div>
                            <div class="mt-3">
                                <button class="button btn-navigate-form-step" type="button"
                                    step_number="2">Prev</button>
                                <button class="button submit-btn" type="submit" name="saveData">Save</button>
                            </div>
                        </section>
                    </form>
                </div>
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
