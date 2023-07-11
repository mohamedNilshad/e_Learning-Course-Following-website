<!DOCTYPE html>
<html lang="en">


<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    {{-- <link rel="stylesheet" href="css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/bootstrap.min.css') }}" />
    <!-- site css -->
    {{-- <link rel="stylesheet" href="style.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/style.css') }}" />

    <!-- responsive css -->
    {{-- <link rel="stylesheet" href="css/responsive.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/responsive.css') }}" />

    <!-- color css -->
    {{-- <link rel="stylesheet" href="css/colors.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/colors.css') }}" />

    <!-- select bootstrap -->
    {{-- <link rel="stylesheet" href="css/bootstrap-select.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/bootstrap-select.css') }}" />

    <!-- scrollbar css -->
    {{-- <link rel="stylesheet" href="css/perfect-scrollbar.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/perfect-scrollbar.css') }}" />

    <!-- custom css -->
    {{-- <link rel="stylesheet" href="css/custom.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/custom.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/fonts/fontawesome-webfont.ttf" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>

    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">
                            <a href="admin-profile"><img class="logo_icon img-responsive"
                                    src="{{ $data->adminProfileImage }}" alt="here" /></a>
                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">
                            <div class="user_img"><img class="img-responsive"
                                    src="{{ $data->adminProfileImage ? $data->adminProfileImage : url('images\Admin\Profile\profile.png') }}"
                                    alt="admin profile" /></div>
                            <div class="user_info">
                                <h6>{{ $data->admin_name }}</h6>
                                <p><span class="online_animation"></span> Online</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">
                    <h4>General</h4>
                    <ul class="list-unstyled components">

                        <li><a href="admin-profile"><i class="fa fa-user-circle orange_color"></i>
                                <span>Profile</span></a>
                        </li>
                        <li><a href="addCat"><i class="fas fa-plus-circle green_color"></i> <span>Add Category</span></a>
                        </li>
                        <li>
                            <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fas fa-users purple_color"></i><span>User Management</span></a>
                            <ul class="collapse list-unstyled" id="element">
                                <li><a href="admin-manage">> <span>Admin</span></a></li>
                                <li><a href="educator-manage">> <span>Educator</span></a></li>
                                <li><a href="student-manage">> <span>Student</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                    class="fas fa-book blue2_color"></i> <span>Courses</span></a>
                            <ul class="collapse list-unstyled" id="apps">
                                <li><a href="pending-approval">> <span>Pending Courses</span></a></li>
                                <li><a href="rejected-approval">> <span>Rejected Courses</span></a></li>
                                <li><a href="published-approval"> <span>Published Courses</span></a></li>
                                <li><a href="deleted-approval"> <span>Deleted Courses</span></a></li>
                            </ul>
                        </li>
                        <li><a href="my-wallet"><i class="fas fa-wallet purple_color2"></i> <span>Wallet</span></a>
                        </li>

                        <li class="active">
                            <a href="#additional_page" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i class="fas fa-chart-bar yellow_color"></i>
                                <span>analytics</span></a>
                            <ul class="collapse list-unstyled" id="additional_page">
                                <li>
                                    <a href="course-analytics">> <span>Course</span></a>
                                </li>
                                <li>
                                    <a href="student-analytics">> <span>Student</span></a>
                                </li>
                                <li>
                                    <a href="educator-analytics">> <span>Educator</span></a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                    class="fa fa-bars"></i></button>
                            <div class="logo_section">
                                <a href="admin-profile"><img class="img-responsive" src="images/Admin/logo/course-mate.png"
                                        alt="#" /></a>
                            </div>
                            <div class="right_topbar">
                                <div class="icon_info">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-bell-o"></i><span
                                                    class="badge">2</span></a></li>
                                        <li><a href="#"><i class="fa fa-envelope-o"></i><span
                                                    class="badge">3</span></a></li>
                                    </ul>
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a class="dropdown-toggle" data-toggle="dropdown"><img
                                                    class="img-responsive rounded-circle"
                                                    src="{{ $data->adminProfileImage ? $data->adminProfileImage : url('images\Admin\Profile\profile.png') }}"
                                                    alt="#" /><span
                                                    class="name_user">{{ $data->admin_name }}</span></a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="admin-profile">My Profile</a>
                                                <a class="dropdown-item" href="logout-admin"><span>Log Out</span> <i
                                                        class="fa fa-sign-out"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- end topbar -->

                <br>
                @if (Session::has('success'))
                    <div class="alert alert-success"
                        style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 45%; top:10%; margin-top: 12px;">
                        {{ Session::get('success') }}</div>
                @elseif(Session::has('fail'))
                    <div class="alert alert-danger"
                        style="width: 30%; text-align: center; padding: 1px; position: absolute; left: 45%; top:10%; margin-top: 12px;">
                        {{ Session::get('fail') }}</div>
                @endif
                <h2>Admin Profile</h2>

                <form action="{{ route('update-admin-profile') }}" method="post" enctype="multipart/form-data"
                    class="col-md-6">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName">Full Name</label>
                        <input type="text" class="form-control" id="exampleInputName"
                            aria-describedby="emailHelp" placeholder="Full Name" name="full_name"
                            value="{{ $data->admin_name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" name="email"
                            value="{{ $data->admin_email }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Choose Profile Image</label>
                        <input type="file" class="form-control-file" accept="image/png, image/jpg, image/jpeg"
                            id="ProfilePicture" name="profile">

                    </div>
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>






    <!-- jQuery -->
    <script src="js/Admin/jquery.min.js"></script>
    <script src="js/Admin/popper.min.js"></script>
    <script src="js/Admin/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="js/Admin/animate.js"></script>
    <!-- select country -->
    <script src="js/Admin/bootstrap-select.js"></script>
    <!-- owl carousel -->
    <script src="js/Admin/owl.carousel.js"></script>
    <!-- chart js -->
    <script src="js/Admin/Chart.min.js"></script>
    <script src="js/Admin/Chart.bundle.min.js"></script>
    <script src="js/Admin/utils.js"></script>
    <script src="js/Admin/analyser.js"></script>
    <!-- nice scrollbar -->
    <script src="js/Admin/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="js/Admin/custom.js"></script>
    <script src="js/Admin/chart_custom_style1.js"></script>

</body>

</html>
