<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/Educator/password_reset.css') }}" />

</head>

<body>

    @if (Session::has('fail'))
        <div class="alert alert-danger" style="width: 28%; text-align: center; padding: 1px;">{{ Session::get('fail') }}
        </div>
    @endif
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="{{ route('admin-verify-code') }}" method="post">
                @csrf
                <br>
                <a href="{{ 'admin-verify-code' }}" style="text-align: start; padding-bottom: 15px;"><i
                        class="fa fa-arrow-left" aria-hidden="true"></i></a>
                <h5>Password Reset</h5>
                <label style="text-align: start; font-size: 12px; color: black; font-weight: 550;"> Enter your OTP:
                </label>
                <input type="number" placeholder="Code" name="code" value="{{ old('code') }}" max="9999"
                    min="1111" title="" style="letter-spacing: 3px; font-size: 20px;" />
                <input type="hidden" name="eID" value="{{ $admin->id }}">
                <span class="text-danger" style="font-size: 12px; text-align: start;">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>

                <button class="btn btn-danger">Reset Password</button>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
