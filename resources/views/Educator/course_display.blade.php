@extends('Educator.layout')
@section('title', 'Course View')

@section('content')
    <!DOCTYPE html>
    <html>

    <head>
        <title></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/Educator/course_view.css">

    </head>

    <body>

        @if (Session::has('success'))
            <div class="alert alert-success"
                style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 30%; top:30%; margin-top: 12px; z-index: 3;">
                {{ Session::get('success') }}</div>
        @elseif(Session::has('fail'))
            <div class="alert alert-danger"
                style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 30%; top:30%; margin-top: 12px;">
                {{ Session::get('fail') }}</div>
        @endif

        <div class="container-course">
            <div style="text-align: left">
                <img src="{{ $course_data->courseThumbnile }}" class="imageCover">
                <h2>{{ $course_data->courseName }}</h2>
            </div>
            <div class="container-course-description">
                <h3>Course Description</h3>
                <p>
                    {{ $course_data->courseDescription }}
                </p>
            </div>
            <i class="fas fa-eye"></i> {{ $course_data->courseViews }} views
            <br>
            <i class="fas fa-star"></i> 4.8 (128) Rating

            <a href="{{ route('edit-course') }}?cid={{ $course_data->id }}"><button type="button"
                    class="btn btn-primary edit-button">Edit Course</button></a>
        </div>

        <div class="container-review">
            <span style="font-size: 20px; font-weight: bold;">Reviews</span><br>
            <hr>
            @foreach ($course_review as $reviewData) 
                <span style="color:black"><b>{{ $reviewData->user->user_name }}</b><span> <span
                            style="color:rgb(71, 70, 70)"> :
                            {{ date('d-m-Y', strtotime($reviewData->updated_at)) }}<span><br>
                                {{ $reviewData->review }} <br><a href="" data-toggle="modal"
                                    data-target="#exampleModal" data-edu="{{ $data->id }}"
                                    data-id="{{ $reviewData->id }}" data-review="{{ $reviewData->review }}"
                                    data-name="{{ $reviewData->user->user_name }}">
                                    replay</a> | <a href="{{ url('delete-review/' . $reviewData->id) }}"> delete </a>
                                @if ($review_replay->count() > 0)
                                    <div class="replay-comments">
                                        @foreach ($review_replay as $replayData)
                                            @if ($reviewData->id == $replayData->review_id)
                                                <span><b> {{ $replayData->educatorReplay->educatorName }} </b></span>
                                                <span>{{ date('d-m-Y', strtotime($replayData->updated_at)) }} </span>
                                                <p>{{ $replayData->replay }} <br><a
                                                        href="{{ url('delete-replay/' . $replayData->id) }}">delete </a>
                                                    <hr>
                                                </p>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                <hr>
            @endforeach

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Replay to </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('review-replay') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Message:</label>
                                    <input type="hidden" name="rID" value="" class="rid">
                                    <input type="hidden" name="eduID" value="" class="eid">

                                    <p></p>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea class="form-control" name="replay" id="message-text"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Replay</button>
                                </div>


                            </form>
                        </div>

                    </div>
                </div>
            </div>

            {{-- </div> --}}

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



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>

        <script>
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var educator = button.data('edu')
                var message = button.data('review') // Extract info from data-* attributes
                var recipient = button.data('name')
                var reviewID = button.data('id') // Extract info from data-* attributes
                // Extract info from data-* attributes

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Replay to ' + recipient)
                // modal.find('.modal-body input').val(reviewID)
                modal.find('.rid').val(reviewID)
                modal.find('.eid').val(educator)
                modal.find('.modal-body p').text(message)

            })
        </script>
    </body>

    </html>


@endsection
