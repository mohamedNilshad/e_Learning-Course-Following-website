<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/fonts/fontawesome-webfont.ttf" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

</head>

<body>
    <div class="alert alert-success" role="alert">
        Course mate recently purchesed user list <span style="float: right">{{ $date = date('Y-m-d') }}</span>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Customer</th>
                <th>Course</th>
                <th>Purchased Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cutCount = 1;
                $pageBreak = 1;
            @endphp
            @foreach ($cutomerData as $purchesData)
                <tr>
                    <td>{{ $cutCount++ }}</td>
                    <td>{{ $purchesData->user_name }}</td>
                    <td>{{ $purchesData->courseName }}</td>
                    <td>{{ $purchesData->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div style=" page-break-after: always;"></div>

    <h2>Testing</h2> --}}
</body>

</html>
