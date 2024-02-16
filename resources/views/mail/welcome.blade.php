<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        p {
            font-size: 12px;
        }

        .signature {
            font-style: italic;
        }
    </style>
</head>

<body>
    <div>
        <h1>This is the welcome mail from Admin.</h1>
        <span>Hello {{ $userDetail->first_name }} {{ $userDetail->last_name }}, </span>
        <p>Your Email id is : {{ $userDetail->email }}
        </p>
        <p>Your OTP Code is : {{ $userDetail->otp_code }}
        </p>
        <p>Thank You</p>
    </div>
</body>

</html>
