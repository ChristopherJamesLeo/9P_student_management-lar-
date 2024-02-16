<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enroll Template</title>
</head>
<body>  
    
    <h3>Dear {{$data["username"]}},</h3>
    Sorry , We Decided You are not qualified to approve for <b>{{$data["subject"]}}</b> <br/>
    
    <div style="margin-top:100px">
        Thank, Regard  <br/>
        {{$data["admit_by"]}} <br/>
    	{{config("app.name")}}
    </div>

</body>
</html>