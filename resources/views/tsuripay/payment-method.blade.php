<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <form action="{{route('tsuripay.paymentMethod')}}" method="post" id="formPayment">
        @csrf
        <input type="number" value="{{$data['price']}}" disabled> <br>
        <input name="data" type="hidden" value="{{json_encode($data)}}">

        <button class="btnPayment" value="現金">現金</button>
        <button class="btnPayment" value="クレジットカード">クレジットカード</button>
        <button class="btnPayment" value="キャッシュレス">キャッシュレス</button>
    </form>
</body>
<script>
    $('.btnPayment').click(function (e) {
        let method = $(this).val();
        $('#formPayment').append('<input type="hidden" name="paymentMethod" value="'+method+'" />');
        $('#formPayment').submit()
    });
</script>
</html>