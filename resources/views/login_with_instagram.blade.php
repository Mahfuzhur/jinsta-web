<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- bootstrap css -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet"
          id="bootstrap-css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>TAG LETTER</title>
</head>
<body class="login-page">
<!-- top header -->

<header>
    <div class="container-fluid">
        <div class="row top_fixed">
            <div class="header_left logo_top">
                <a href="{{URL::to('/')}}" class="logo_holder">
                    <img src="{{URL::to('assets/img/logo.png')}}" alt="">
                </a>

                <!-- <h4>
                  <a href="{{URL::to('/')}}">
                    <span class="logo_sec">LOGO</span>
                  </a>
                </h4> -->
            </div>
            <!-- <div class="header_right">
                 <img class="user_img" src="{{asset('assets/img/user.png')}}">
            </div> -->
        </div>

    </div>

</header>

<div id="wrapper" class="toggled">
    <!-- toggle menu -->
    <a href="#menu-toggle" class="btn btn-secondary" id="sidebar_toggle">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </a>
    <!-- Sidebar -->
    <!-- <div id="sidebar-wrapper">
        <div class="sidebar">
            <a class="template" href="{{URL::to('manuscript-registration')}}"><span class="sidebar_icon"><img src="{{asset('assets/img/send.png')}}" alt=""></span>原稿登録</a>
            <a class="Plan" href="{{URL::to('destination-registration')}}"><span class="sidebar_icon"><img src="{{asset('assets/img/person.png')}}" alt=""></span>宛先登録</a>
            <a class="Schedule" href="{{URL::to('delivery-setting')}}"><span class="sidebar_icon">
                  <img src="{{asset('assets/img/calandersetting.png')}}" alt="">
              </span>配信設定</a>
            <a class="Progress" href="{{URL::to('analytics')}}"><span class="sidebar_icon">
                  <img src="{{asset('assets/img/analytics.png')}}" alt="">
              </span>アナリティクス</a>
            <a class="Summary" href="{{URL::to('request')}}"><span class="sidebar_icon">
                  <img src="{{asset('assets/img/payment.png')}}" alt="">
              </span>ご請求</a>
        </div>
    </div> -->
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="login-holder" style="left: 40%; top: 40%;">
                    <!-- @if(!Auth::user())
                      <a href="{{URL::to('instagram-info')}}"><img src="{{asset('assets/img/instagram.png')}}" alt="instagram"></a>
                    @endif -->
                    <a href="{{URL::to('user-registration')}}">
                        <button class="btn btn-info btn-lg" style="background-color: #06af94">新規登録</button>
                    </a>
                    <a href="{{URL::to('user-login')}}">
                        <button class="btn btn-info btn-lg" style="background-color: #06af94">ログイン</button>
                    </a>
                    <!-- <a href="{{URL::to('admin')}}">
                        <button class="btn btn-info btn-lg" style="background-color: #06af94">管理者ログイン</button>
                    </a> -->
                    <!-- <p class="login_text">Instagram でログイン</p> -->
                </div>
<!--                <div class="envelope_area">-->
<!--                    <div class="envelope">-->
<!--                        <a href="#">-->
<!--                            <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>

    </div>
    <!-- /#page-content-wrapper -->
</div>


<!-- jquery core -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!-- custom js -->
<script src="{{asset('assets/js/main.js')}}"></script>

</body>
</html>
