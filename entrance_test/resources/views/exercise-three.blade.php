<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <style>
        .alert {
            padding: 20px;
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
            display: none;
        }

        /* The close button */
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* When moving the mouse over the close button */
        .closebtn:hover {
            color: black;
        }
    </style>

    <div class="container">
        <h2>The requested amount is $<span id="change-price">{!! $amounts !!}</span> </h2>
        @foreach ($price as $key => $value)
            <button type="button" class="btn btn-success" onclick="getPrice({!! $value !!},{!! $amounts !!})">{!! $value !!}</button>
        @endforeach
    </div>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <p class="msg"></p>
    </div>
    <div class="history">
        <p class="msg"> Ban vua rut: {!!  !!}</p>
    </div>


</body>
</html>
<script>
    function getPrice(price, amounts) {
        let amountNew = null;
        if (amountNew !== null)
        {
            amounts = amountNew;
        }
        $.ajax({
            url: '/exercise-amounts',
            type:'POST',
            async:false,
            data: { price: price, amounts: amounts, _token: '{{csrf_token()}}' },
            success:function(data){
                console.log(data);
                if (data.status !== 400) {
                    $('#change-price').text(data.amountNew);
                } else {
                    $(".alert").show();
                    $(".msg").text(data.msg);
                }


            }

        });

    }
</script>
