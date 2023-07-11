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
    <title>CourseMate - Admin</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/bootstrap.min.css') }}" />
    <!-- site css -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/style.css') }}" />

    <!-- responsive css -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/responsive.css') }}" />

    <!-- color css -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/colors.css') }}" />

    <!-- select bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/bootstrap-select.css') }}" />

    <!-- scrollbar css -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/perfect-scrollbar.css') }}" />

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/custom.css') }}" />

    <!-- calendar file css -->
    {{-- <link rel="stylesheet" href="js/semantic.min.css" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ url('/css/Admin/semantic.min.css') }}" /> --}}


</head>

<body class="inner_page login">

    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                @if (Session::has('fail'))
                    <div class="alert alert-danger" style="width: 50%; text-align: center; padding: 1px; position: absolute; top:1.5%;">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                            <img width="210" src="images/Admin/logo/course-mate.png" alt="Course Mate Logo" />
                        </div>
                    </div>
                    <div class="login_form">
                        <form action="{{ route('login-admin') }}" method="post">
                            @csrf
                            <fieldset>
                                <div class="field">
                                    <label class="label_field">Email Address</label>
                                    <input type="email" name="email" placeholder="E-mail"
                                        value="{{ old('email') }}" />
                                    <span class="text-danger" style="font-size: 12px; text-align: start;">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                                <div class="field">
                                    <label class="label_field">Password</label>
                                    <input type="password" name="password" placeholder="Password"
                                        value="{{ old('password') }}" />
                                    <span class="text-danger" style="font-size: 12px; text-align: start;">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>
                                <div class="field">
                                    <label class="label_field hidden">hidden label</label>

                                    <a class="forgot" href="{{ route('forgot-admin-password') }}">Forgotten
                                        Password?</a>
                                </div>
                                <div class="field margin_0">
                                    <label class="label_field hidden">hidden label</label>
                                    <button class="main_bt">Sing In</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="js/animate.js"></script>
    <!-- select country -->
    <script src="js/bootstrap-select.js"></script>
    <!-- nice scrollbar -->
    <script src="js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>
