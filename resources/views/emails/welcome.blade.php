

<html>
<head>
    <title>

    </title>
</head>
<body>
Hey {{$name}}, Welcome to our website. <br>
Please click <a href="{!! url('/verify', ['code'=>$verification_code]) !!}"> Here</a> to confirm email
</body>
</html>