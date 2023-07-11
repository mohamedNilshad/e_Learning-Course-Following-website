<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="css/Educator/nav.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>@yield('title')</title>

    <style>
        .profile-image {
            border-radius: 100%;
            /*border: 5px solid white;*/
            position: relative;

            top: 21%;
            width: 3.5%;
            height: 15%;
            /*background-color: gray;*/
            text-align: center;


        }

        .pr-image {
            border-radius: 50%;
            width: 95%;
            height: 45px;
            border: 5px solid white;
        }

        .badge {
            background-color: red;
            color: white;
            padding: 2px 8px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
    <script>
        function currentpage(element) {
            console.log('element');
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="profile-image">
            <img src="{{ $data->educatorProfileImage == '' ? 'images/profile.png' : $data->educatorProfileImage }}"
                class="pr-image">
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                    <a class="nav-link" href="home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
                    <a class="nav-link" href="profile">Profile</a>
                </li>
                <li class="nav-item {{ Request::is('create_new') ? 'active' : '' }}">
                    <a class="nav-link" href="create_new">Create new</a>
                </li>
                <li class="nav-item {{ Request::is('report') ? 'active' : '' }}">
                    <a class="nav-link" href="report">Reports</a>
                </li>
                <li class="nav-item {{ Request::is('wallet') ? 'active' : '' }}">
                    <a class="nav-link" href="wallet">Wallet</a>
                </li>
                <li class="nav-item {{ Request::is('notification') ? 'active' : '' }}">
                    <a class="nav-link" href="notification">Notification
                        {{-- {{ $notifiCount->count() == 0 ? '' : <span class="badge"> . $notifiCount->count() . </span> }} --}}
                        @if ($notifiCount->count() > 0)
                            <span class="badge">{{ $notifiCount->count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item {{ Request::is('logout') ? 'active' : '' }}">
                    <a class="nav-link" href="logout">Logout</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    @yield('content')

    <script>
        // // Add active class to the current button (highlight it)
        // var header = document.getElementById("myDiv");
        // var btns = header.getElementsByClassName("navs");
        // for (var i = 0; i < btns.length; i++) {
        //   btns[i].addEventListener("click", function() {
        //   var current = document.getElementsByClassName("active");
        //   current[0].className = current[0].className.replace(" active", "");
        //   this.className += " active";
        //   });
        // }

        // function currentpage(element) {
        //   console.log('element');
        // }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>
