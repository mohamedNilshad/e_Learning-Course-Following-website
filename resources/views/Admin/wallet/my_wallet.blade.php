@extends('Admin.layout')
@section('title', 'My Wallet')

@section('content')
    <br>
    <!-- Earnings Section -->
    <div class="container mt-4">

        <h1>Earnings</h1>
        <div style="text-align: end">
            {{-- <a href="CompWithdraw" style="text-decoration: none;">Withdraw</a> --}}

            @if ($balanceAmount > 50)
                <a href="CompWithdraw" style="text-decoration: none;">Withdraw</a>
            @else
                <p style="color: red"> Your Available Balance should be at least $50 to withdraw</p>
            @endif
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">This Month</h5>
                        <p class="card-text">Total Earnings: $ {{ $last30DayAmount }}</p>
                        {{-- <p class="card-text">From Course(s)</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lifetime</h5>
                        <p class="card-text">Total Earnings: ${{ $LifetimeAmount }}</p>
                        {{-- <p class="card-text">From  Course(s)</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body text-center" style="line-height: 1;">
                        <h5 class="card-title  text-left">Withdrawal</h5>
                        <p class="card-text" style="font-size: 30.5px; color:white">$ {{ $balanceAmount }}</p>
                        <p class="card-text" style="color:white">Available for withdrawal</p>
                    </div>
                </div>
            </div>
        </div>


        <h2 class="mt-4">Recent Sales </h2>
        <div style="text-align: end"><a href="genarate_pdf_admin"><i class="fas fa-print fa-2x"></i></a></div>
        <br>
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
                    <button class="btn btn-success" data-dismiss="modal"><span>That's Great!</span></button>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('AdminWithdrawed'))
        <script>
            var modal = document.querySelector('#myModal');
            var modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
        </script>
    @endif

@endsection
