<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @vite('resources/js/app.js')
    <div id="message">
        @foreach ($messages as $message)
            <span>{{ $message->messages}}</span> <br>
        @endforeach
    </div>
</body>
<script type="module">
    Echo.channel('messageChannel')
        .listen('sendMessage', (e)=>{
            let message = document.getElementById("message");
            message.innerHTML += `<span>${e.message}</span> <br>`
        })
</script>
</html>
