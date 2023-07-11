@extends('Admin.layout')
@section('title', 'Published Course View')

@section('content')
    <br>
    <h2>Published Course View</h2>

    <div class="container-course">
        <div style="text-align: left">
            <img src="{{ $course->courseThumbnile }}" class="imageCover">
            <h2>{{ $course->courseName }}</h2>
        </div>
        <div class="container-course-description">
            <h3>Course Description</h3>
            <p>
                {{ $course->courseDescription }}
            </p>
        </div>
        <i class="fas fa-eye"></i> {{ $course->courseViews }} views
        <br>
        <i class="fas fa-star"></i> 4.8 (128) Rating

        
    </div>
    <div class="edit-button">
        <a href="{{ route('delete-course') }}?cid={{ $course->id }}&status={{ $course->publishCourse}}" class="btn btn-primary">Delete</a>
        <a href="{{ route('reject-course') }}?cid={{ $course->id }}&status={{ $course->publishCourse}}" class="btn btn-danger">Reject</a>
    </div>

    <div class="main-video">
        <div class="row">
            <div class="carousel" style="width: 100%">
                @php $i=0 @endphp
                @foreach ($course_video as $fv_item)
                    @if ($i == 0)
                        <div><iframe src="{{ $fv_item->video_url }}" autoplay=0 allowfullscreen frameborder="0"
                                name="slider1"></iframe></div>
                        @php $i=1 @endphp
                    @endif
                @endforeach

                <span style="width: 80%">
                    @foreach ($course_video as $key => $video_item)
                        @if ($key >= 1)
                            <a href="{{ $video_item->video_url }}" target="slider1"><img
                                    src="{{ $video_item->video_thumb_url }}"></a>
                        @endif
                    @endforeach
                </span>
            </div>
        </div>
    </div>
    <div class="doc">

    </div>

@endsection
