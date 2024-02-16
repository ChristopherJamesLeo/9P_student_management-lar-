<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enroll Template</title>
</head>
<body>
    <h3>Dear {{$data["username"]}},</h3>
    Congratulation , We Are <u>{{$data["stage"]}}</u> For Your <b>{{$data["subject"]}} , </b><br/>
    Zoom Class Start Time is <b>{{$data["starttime"]}}</b> and end Time is <b>{{$data["endtime"]}}</b> ,  
    Class Start Date is <b>{{$data["startdate"]}}</b> and End Date Will be <b>{{$data["enddate"]}}</b> <br/>
    Zoom Id - {{$data["zoomid"]}} <br/>
    Passcode - {{$data["passcode"]}} <br/>
    
    
    <div style="margin-top:100px">
        Thank, Regard  <br/>
        {{$data["admit_by"]}} <br/>
    	{{config("app.name")}}
    </div>
    

</body>
</html>