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
    <form action="{{ route('tsuripay.payment') }}" method="post" id="formPayment">
        @csrf
        <input name="data" type="hidden" value="{{ json_encode($data) }}">
        <input name="paymentMethod" type="hidden" value="{{ $payment_method }}">
        <input class="outPrice" name="out_price" type="hidden">

        User name <input type="text" disabled value="{{ $data['user_name'] }}"> <br>
        Title <input type="text" disabled value="{{ $data['title'] }}"> <br>
        Price <input class="price" type="text" disabled value="{{ $data['price'] }}"> <br>
        User Price <input class="userPrice" type="number" name="user_price"> <br>
        Out price <input class="outPrice" type="text" disabled> <br>
        <button class="btnSubmitPayment">Submit</button>
    </form>
</body>
<script>
    $('.userPrice').keyup(function(e) {
        let outPrice = $('.outPrice')
        const data = $(this).val();
        let price = $('.price').val();
        let result = data - price;
        outPrice.val(result)
    });
    $('.btnSubmitPayment').click(function(e) {
        e.preventDefault();
        let outPrice = $('.outPrice').val();
        if (outPrice < 0 || outPrice == null || outPrice == " " || !outPrice) {
            alert('false')
        } else {
            $('#formPayment').submit()
        }
    });
</script>

</html>
