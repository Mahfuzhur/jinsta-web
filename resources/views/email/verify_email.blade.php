

<!--<button href="{{URL::to('verify/'.$token)}}">verify</button>-->
<!--<a href="{{URL::to('verify/'.$token)}}">verify</a>-->
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Confirmation of Email</title>
</head>
<body>
<div class="card text-center">
    <div class="card-header">
<!--        <img src="{{asset('assets/img/logo.png')}}" alt="">-->
        <p class="card-text"><b>Confirm Your Email</b></p>
    </div>
    <div class="card-body">
        <h5 class="card-title">Dear Mahmudul,</h5>
        <p class="card-text">Thanks for Joining our International community. To Complete your Registration, Please
            Confirm Your Email Address:</p>
        <a href="{{URL::to('verify/'.$token)}}" class="btn btn-success">Confirm Email</a>
        <p class="card-text">This Link is Unique to Your Account and Can't be Shared. It Will Expire in 14 Days. If You
            Need any help you can always reach us at <b>dosnixtech@gmail.com</b>
            <br>
            <br>
            Enjoy the International Experience!!
            <br>
            <b>Your DosNix Team</b>
        </p>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>



