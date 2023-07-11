@extends('Educator.layout')
@section('title', 'Edit Course')

@section('content')


    <!DOCTYPE html>
    <html>

    <head>
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


        @if (Session::has('success'))
            <div class="alert alert-success"
                style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 30%; top:28%; margin-top: 12px;">
                {{ Session::get('success') }}</div>
        @elseif(Session::has('fail'))
            <div class="alert alert-danger"
                style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 30%; top:28%; margin-top: 12px;">
                {{ Session::get('fail') }}</div>
        @endif

        <!-- body -->

        <div class="container-body">
            <div id="multi-step-form-container">
                <!-- Step Wise Form Content -->
                <form action="{{ route('update-new') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Step 1 Content -->
                    <section id="step-1" class="form-step">
                        <h2 class="font-normal">Update Course Details</h2>
                        <hr style="height:2px;border:none;color:#333;background-color:#333;"><br>
                        <!-- Step 1 input fields -->
                        <div class="mt-3">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="inputName">Course Title</label>
                                    <input type="text" class="form-control" id="inputName" name="course_title"
                                        value="{{ $course->courseName }}" placeholder="Course Title" required="">
                                    <input type="hidden" name="crsId" value="{{ $course->id }}">
                                    {{-- <input type="hidden" name="eduId" value="{{$data->id}}"> --}}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="description">Course Description</label>
                                    <textarea class="form-control" id="course_description" name="course_description" rows="3" required="">{{ $course->courseDescription }}</textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCategory">Category</label>
                                    <select class="form-control" name="course_category" required="">

                                        @foreach ($topic as $topicItem)
                                            @if ($topicItem->id == $course->topic_id)
                                                <option value="{{ $topicItem->id }}" selected>{{ $topicItem->topic }}
                                                </option>
                                            @else
                                                <option value="{{ $topicItem->id }}">{{ $topicItem->topic }}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputName">Course Price</label>
                                    <input type="number" class="form-control" id="inputName" name="course_price"
                                        placeholder="Price in $" min="0"
                                        value="{{ $course->coursePrice }}"required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <img src="{{ $course->courseThumbnile }}"width="15%">

                                <div class="form-group col-md-4">
                                    <label for="inputThumbnile">Course Thumbnile</label>
                                    <input type="file" class="form-control-file"
                                        accept="image/png, image/jpg, image/jpeg" id="inputProfile" name="course_thumbnile">
                                </div>
                            </div>
                        </div>

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
                    <li class="list-group-item sel" style="background-color: lightsteelblue"><a
                            href="{{ route('edit-course') }}?cid={{ $course->id }}">Course Details</a></li>
                    <li class="list-group-item sel"><a href="{{ route('edit-videos') }}?cid={{ $course->id }}">Course
                            Videos</a></li>
                    <li class="list-group-item sel"><a href="{{ route('add-videos') }}?cid={{ $course->id }}">Add New
                            Videos</a></li>
                </ul>
            </div>
        </div>




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
