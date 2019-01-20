<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- bootstrap css -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> 
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>宛先登録</title>
  </head>
  <body>
    <!-- top header -->

    <header>
      <div class="container-fluid">
        <div class="row top_fixed">
          <div class="header_left logo_top">
            <h4>
              <a href="{{URL::to('/')}}">
                <span class="logo_sec">LOGO</span>
              </a>
          </h4>
          </div>
          <div class="header_right">
               <img class="user_img" src="{{asset('assets/img/user.png')}}">
          </div>
        </div>
      </div>
    </header>

    @yield('content')

    

    <!-- jquery core -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- custom js -->
    <script src="{{asset('assets/js/main.js')}}"></script>   
    
  </body>
</html>