@extends('Educator.layout')
@section('title', 'Notification')

@section('content')
    <!DOCTYPE html>
    <html>

    <head>
        <title></title>

        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="css/Educator/notification.css">
    </head>

    <body>
        <!-- course Card -->
        <div class="container-body "style="width: 40rem;">
            @if ($notification->count() != 0)
                @foreach ($notification as $Notify)
                    <div class="card card-size">
                        <div class="card-header">
                            {{$Notify->courseName}}<span style="font-size: 15px; float: right;">{{$Notify->created_at}}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Dear Educator!</h5>
                            <p class="card-text">{{$Notify->message}}</p>
							@if ($Notify->isRead == 0)
                            <a href="educator-read-status?nid={{$Notify->id}}&read={{$Notify->isRead}}" class="btn btn-primary">Mark as read</a>
								
							@else
                            <a href="educator-read-status?nid={{$Notify->id}}&read={{$Notify->isRead}}" class="btn btn-danger">Mark as unread</a>
								
							@endif
                        </div>
                    </div>
                @endforeach

            @endif
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
    </body>

    </html>


@endsection
