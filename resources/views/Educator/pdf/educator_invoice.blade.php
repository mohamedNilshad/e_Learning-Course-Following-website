<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transection Invoice</title>

    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div style="font-family: arial;">
        <div style="width: auto; height: auto;">
            {{-- <img src="images/logo/coursemateLogo.png"> --}}
            <h2 style="font-family: sans-serif;"><span style="color: #34568B">Course</span> Mate <span
                    style="float: right; font-size: 15px; ">{{ date('y-m-d') }}</span></h2>
        </div>
        <hr>
        <h4>Dear Educator</h4>
        Your payment from Course-mate is now being processed.
        <p style="font-weight: bold;">
            Your payment is expected to arrive by the end of the day. Payments processed late in the day or outside
            business hourse typically arrive on the following business day.
        </p>
        Here are the details:
        <br>
        <br>
        <table id="customers" style="width: 60%">

            <tr>
                <td style="font-weight:bold;">Payment Amount</td>
                <td>${{ $data['paymentAmount'] }}</td>
            </tr>
            <tr>
                <td style="font-weight:bold;">Payment ID</td>
                <td>{{ $data['paymentID'] }}</td>
            </tr>
            <tr>
                <td style="font-weight:bold;">Bank Account (Last Four Digits)</td>
                <td>{{ $data['accountNumber'] }}</td>
            </tr>
            <tr>
                <td style="font-weight:bold;">Date</td>
                <td>{{ $data['paymentDate'] }}</td>
            </tr>

        </table>

    </div>



</body>

</html>
