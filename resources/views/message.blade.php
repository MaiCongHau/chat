<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('send.message') }}" method="post">
        @csrf
        <input type="text" name="message">
        <button type="submit">Send</button>
    </form>
</body>
</html>