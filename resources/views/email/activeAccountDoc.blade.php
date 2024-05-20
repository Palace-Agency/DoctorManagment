<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Acive Account</title>
</head>
<body>
    <h3>Hello doctor {{$user->fname .' '.$user->lname}}</h3>
    <p>here is the Link to continue creating you account</p>
    <p>link: <a class="btn btn-primary" href="{{route('active.doc',$user->id)}}">Acive Account</a></p>
    <p>Thank you for registering with us!</p>
</body>
</html>


