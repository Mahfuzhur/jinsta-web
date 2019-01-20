<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <!-- Bootstrap -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    
    <!--    font-awesome css-->
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}"/>
    
    <!--    custom css-->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/media.css')}}"/>
    
    <!--    animate css-->
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}"/>
    
    <!--    jquery UI css-->
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.theme.min.css')}}"/>
    
    <!--    slick css-->
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/slick-theme.css')}}"/>
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <title>Jinsta</title>
</head>
<body>

  <!-- Top nav section-->
  
    <div class="container side_space_remove">
      <div class="row top_fixed">
        <div class="col-md-2 col-sm-2 col-xs-2 logo_top">
          <h4>
            <a href="{{URL::to('/')}}"><span class="logo_sec">LOGO</span></a>
          </h4>
        </div>

        <div class="col-md-8 col-sm-8 col-xs-8">
        
        </div>

        <!-- <div class="col-md-2 col-sm-2 col-xs-2">
             <img class="user_img" src="{{asset('assets/img/user.png')}}">
        </div> -->

      </div>
    </div>


   <!-- //Top nav section-->


   

    <div class="container side_space_remove">
      <div class="row entire_border">

         <div class="col-md-2">
           <div class="sidebar">
            <!-- <ul class="nav nav-sidebar">
              <li class="active"><a class="Template" href="{{URL::to('template')}}">Template </a></li>
              <li><a class="Plan" href="#">Plan</a></li>
              <li><a class="Schedule" href="#">Schedule</a></li>
              <li><a class="Progress" href="#">Progress</a></li>
              <li><a class="Summary" href="#">Summary</a></li>
            </ul> -->
           </div>
          </div>


         <div class="col-md-10">
            <div class="test_section">
               <div class="test"><center>Login</center></div>
               <center>
                @if(session('login_error'))
                <div class="alert alert-danger">
                  {{ session('login_error') }}
                </div> 
                @endif
                  <form action="{{URL::to('login')}}" method="post">
                    {{csrf_field()}}
                    <input type="text" name="username" placeholder="Enter username">
                    <input type="password" name="password" placeholder="Enter password">
                    <button type="submit" class="btn-success">Submit</button>
                  </form><br>
               </center>
            </div>
         </div>


            </div> 

       </div>






<!--  Main jquery Starts-->
    <script src="{{asset('assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--    Main jquery Ends-->
    
    <!--    Boosstrap js stat-->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!--    Bootstarp js Ends--> 
    
    <!--    slick slider js start-->
    <script src="{{asset('assets/js/slick.js')}}"></script>
    <!--    slick slider js ends-->
    
    <!--    jquery UI starts-->
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <!--    jquery UI ends-->
    
    <!--    wow js starts-->
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <!--    wow js ends-->



</body>
</html>
