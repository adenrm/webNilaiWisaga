<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page</title>
    @vite('resources/css/app.css')
</head>
<body style="
            background-image: url('{{asset('img/background-1.jpg')}}');
            " class="bg-cover">
        <nav class="flex flex-col gap-5 justify-center items-center h-screen">
            <a class="btn-primary px-8" href="{{route('register')}}">Register</a>
            <a class="btn-primary px-11"  href="{{route('login')}}">Login</a>
        </nav>
</body>
</html>