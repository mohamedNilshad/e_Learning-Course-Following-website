@extends('Educator.layout')
@section('title', 'Wallet')

@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="css/Educator/report.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>

    <body>

        @if ($course->count() > 0)
            <!-- Earnings Section -->
            <div class="container mt-4">

                <h1>Earnings</h1>
                <div style="text-align: end">
                    @if ($balanceAmount > 50)
                        <a href="EduWithdraw" style="text-decoration: none;">Withdraw</a>
                    @else
                        <a href="educator_payment_invoice" class="btn btn-primary" data-dismiss="modal"><span>Print
                                Bill</span></a>

                        <p style="color: red"> Your Available Balance should be at least $50 to withdraw</p><br>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">This Month</h5>
                                <p class="card-text">Total Earnings: $ {{ $last30DayAmount }}</p>
                                <p class="card-text">From {{ $totalCourselast30Day }} Course(s)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Lifetime</h5>
                                <p class="card-text">Total Earnings: ${{ $LifetimeAmount }}</p>
                                <p class="card-text">From {{ $totalCourseLifeTime }} Course(s)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center" style="line-height: 1;">
                                <h5 class="card-title  text-left">Withdrawal</h5>
                                <p class="card-text" style="font-size: 30.5px">$ {{ $balanceAmount }}</p>
                                <p class="card-text">Available for withdrawal</p>
                            </div>
                        </div>
                    </div>
                </div>


                <h2 class="mt-4">Recent Sales </h2>
                <div style="text-align: end"><a href="genarate_pdf_educator"><i class="fas fa-print fa-2x"></i></a></div>

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
            </div>

            <!-- Modal HTML -->
            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center">
                            <div class="icon-box">
                                <i class="material-icons">&#xE876;</i>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body text-center">
                            <h4>Your amount on their way!</h4>
                            <p>Funds should land in your account within 7 business days</p>
                            <a href="educator_payment_invoice" class="btn btn-success" data-dismiss="modal"><span>That's
                                    Great!</span></a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div style=" text-align: center; position: absolute; top:50%; left: 45%">
                <i class="fas fa-file-invoice-dollar fa-lg"></i><br>
                No Sales Yet<br>
            </div>
        @endif

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        @if (Session::has('Withdrawed'))
            <script>
                // Withdrawal button click event
                // document.querySelector('.btn-primary').addEventListener('click', function() {
                //     alert('Withdrawal request submitted!');
                // });

                // Call the modal with id "myModal"

                var modal = document.querySelector('#myModal');
                var modalInstance = new bootstrap.Modal(modal);
                modalInstance.show();
            </script>
        @endif



    </body>

    </html>

@endsection
