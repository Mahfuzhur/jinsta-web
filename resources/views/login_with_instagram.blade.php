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

    <title>login page</title>
  </head>
  <body class="login-page">
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

    <div id="wrapper" class="toggled">
      <!-- toggle menu -->
      <a href="#menu-toggle" class="btn btn-secondary" id="sidebar_toggle">
          <i class="fa fa-bars" aria-hidden="true"></i>
      </a>
      <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar">
                <a class="template" href="{{URL::to('manuscript-registration')}}">原稿登録</a>
                <a class="Plan" href="{{URL::to('destination-registration')}}">宛先登録</a>
                <a class="Schedule" href="{{URL::to('delivery-setting')}}">配信設定</a>
                <a class="Progress" href="{{URL::to('analytics')}}">アナリティクス</a>
                <a class="Summary" href="{{URL::to('request')}}">ご請求</a>
            </div>            
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
              <div class="row">
                  <div class="login-holder">
                    @if(!Auth::user())
                      <a href="{{URL::to('instagram-info')}}"><img src="{{asset('assets/img/instagram.png')}}" alt="instagram"></a>
                    @endif
                      <a href="{{URL::to('user-registration')}}">
                        <button class="btn btn-secondary btn-lg">Register</button>
                      </a>
                      <a href="{{URL::to('user-login')}}">
                        <button class="btn btn-info btn-lg">Login</button>
                      </a>
                      <p class="login_text">Instagram でログイン</p>
                  </div>
              </div>               
            </div>
        </div>
          <!-- /#page-content-wrapper -->
      </div>


    <!-- jquery core -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- custom js -->
    <script src="{{asset('assets/js/main.js')}}"></script>
  
  </body>
</html>
