@extends('Admin.layout')
@section('title', 'Published Approvel')

@section('content')
    <br>

    @if (Session::has('success'))
        <div class="alert alert-success"
            style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 45%; top:10%; z-index: 55; margin-top: 12px;">
            {{ Session::get('success') }}</div>
    @elseif(Session::has('fail'))
        <div class="alert alert-danger"
            style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 45%; top:10%; margin-top: 12px;">
            {{ Session::get('fail') }}</div>
    @endif

    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title">
                        <h2>Pending Approvel</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row column4 graph">
                <!-- Gallery section -->
                <div class="col-md-12">
                    <div class="white_shd full margin_bottom_30">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Courses</h2>
                            </div>
                        </div>
                        <div class="full gallery_section_inner padding_infor_info">
                            <div class="row">
                                @if ($course->count() > 0)
                                    @foreach ($course as $courseItem)
                                        <div class="col-sm-4 col-md-3 margin_bottom_30">
                                            <div class="column">
                                                <a data-fancybox="gallery" href="{{ $courseItem->courseThumbnile }}"><img
                                                        class="img-responsive" src="{{ $courseItem->courseThumbnile }}"
                                                        alt="#" /></a>
                                            </div>
                                            <a href="pending-course-view?id={{ $courseItem->id }}">
                                                <div class="heading_section">
                                                    <h4 style="padding-bottom: 5px">{{ $courseItem->courseName }}</h4>
                                                    <h6 style="text-align: center; color: aliceblue; padding-bottom: 5px">
                                                        By:
                                                        {{ $courseItem->educator->educatorName }}</h6>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div style=" text-align: center; position: absolute; top:75px;left: 45%">
                                        <i class="fa-solid fa-school-circle-exclamation fa-2xl"></i><br>
                                        <b>No Courses Yet</b><br>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            {{-- <div class="container-fluid">
                <div class="row">
                    <div class="footer">
                        <p>Copyright © 2018 Designed by html.design. All rights reserved.</p>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- end dashboard inner -->
    </div>
@endsection
