<html>
<head>
    <title>Account Created</title>
</head>
<body>
    <h3>Hello from your doctor {{Auth::user()->fname .' '.Auth::user()->lname}}</h3>
    <h1>I hope you doing well, {{ $user->fname }} {{ $user->lname }}</h1>
    <p>Your account has been created successfully, for easiest comminucation and to see your progresse in the full image .</p>
    <p>Email: {{ $user->email }}</p>
    <p>Password : password</p>
    <p>Thank you for registering with us!</p>
</body>
</html>


