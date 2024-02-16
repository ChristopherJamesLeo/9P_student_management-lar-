<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <h3>Dear {{$data["username"]}},</h3>
    <p class="" style="text-indent: 70px">
        {!!$data["content"]!!}
    </p>
    
    
    <div style="margin-top:100px">
        Thank, Regard  <br/>
        {{$data["sendby"]}} <br/>
    	{{config("app.name")}}
    </div>
    

</body>
</html>