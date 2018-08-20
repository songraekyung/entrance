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
            padding: 10px;
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
            display: none;
            margin-top: 15px;
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
        .btn-default{
            margin-top: 15px;
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
    <button type="button" class="btn btn-default" onclick="showHistory()">Show History</button>
    <div class="msg-history" style="display: none; ">
        <h3 class="msg-history"> Ban vua rut: </h3>
        <div id="show-table"></div>
    </div>


</body>
</html>
<script>
    function getPrice(price, amounts) {

        $.ajax({
            url: '/exercise-amounts',
            type:'POST',
            async:false,
            data: { price: price, amounts: amounts, _token: '{{csrf_token()}}' },
            success:function(data){
                console.log(data);
                if (data.status !== 400) {
                    location.reload();
                } else {
                    $(".alert").show();
                    $(".msg").text(data.msg);
                }


            }

        });

    }
    function showHistory() {

        $.ajax({
            url: '/exercise-show-history',
            type:'GET',
            async:false,
            success:function(data){
                $(".msg-history").show();
                $("#show-table").append(data.zone);


            }

        });

    }
</script>
