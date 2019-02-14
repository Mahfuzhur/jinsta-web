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
    <!-- jQuery  ui -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <title>
    @if(isset($title))
    {{$title}}
    @else
    Jinsta
    @endif</title>
  </head>
  <body class="delivery_setting_page">
    <!-- top header -->

    <header>
      <div class="container-fluid">
        <div class="row top_fixed">
          <div class="header_left logo_top">
              <a href="{{URL::to('dashboard')}}" class="logo_holder">
                <img src="{{asset('assets/img/logo.png')}}" alt="">
              </a>
          </div>
          <div class="header_right">
              <div class="user_area">
                <a class="dropdown_menu" href="#" role="button" id="" >
                  {{Auth::user()->name}}
                  <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                </a>
                <a class="btn btn-info btn-sm" style="margin: 6px;" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <div class="dropdown-item-holder">
                    <a class="dropdown-item" href="#">Login</a>
                    <a class="dropdown-item" href="#">Logout</a>                    
                </div>
              </div>
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
              @if(isset($active_manuscript))
                <a class="template active" href="{{URL::to('manuscript-registration')}}">
                  <span class="sidebar_icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                  原稿登録
                </a>
              @else
                <a class="template" href="{{URL::to('manuscript-registration')}}">
                  <span class="sidebar_icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                  原稿登録
                </a>
              @endif
              @if(isset($active_destination))
                <a class="Plan active" href="{{URL::to('destination-registration')}}">
                  <span class="sidebar_icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  宛先登録
                </a>
              @else
                <a class="Plan" href="{{URL::to('destination-registration')}}">
                  <span class="sidebar_icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  宛先登録
                </a>
              @endif
              @if(isset($delivery_setting))
                <a class="Schedule active" href="{{URL::to('delivery-setting')}}">
                  <span class="sidebar_icon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>
                  配信設定
                </a>
              @else
              <a class="Schedule" href="{{URL::to('delivery-setting')}}">
                  <span class="sidebar_icon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>
                  配信設定
                  </a>
              @endif
              @if(isset($analytics))
                <a class="Progress active" href="{{URL::to('analytics')}}">
                  <span class="sidebar_icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></span>
                  アナリティクス
                </a>
              @else
              <a class="Progress" href="{{URL::to('analytics')}}">
                  <span class="sidebar_icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></span>
                  アナリティクス
                </a>
              @endif
                <a class="Summary" href="{{URL::to('request')}}">
                  <span class="sidebar_icon"><i class="fa fa-clone" aria-hidden="true"></i></span>
                  ご請求
                </a>
            </div>            
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        @yield('user_main_content')
          <!-- /#page-content-wrapper -->
      </div>


    <!-- jquery core -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- custom js -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script>
      // custom date format
      $(function(){
        $("#delivery_pr_start").datepicker({ dateFormat: 'dd-mm-yy'});
        $("#delivery_pr_end").datepicker({ dateFormat: 'dd-mm-yy'});
        $("#except_start").datepicker({ dateFormat: 'dd-mm-yy'});
        $("#except_end").datepicker({ dateFormat: 'dd-mm-yy'});
      });

      function readURL(input) { 
        $('.preview').show();
          $('#blah').hide();
          $('#title').hide();
          $('#description').hide();
          $('.image_show').after('<img id="blah" src="#" alt="your image" style="display:none;"/>');
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#blah')
              .attr('src', e.target.result)
              .width(250)
              .height(200);
            };
            reader.readAsDataURL(input.files[0]);
          }
        }

        function getPreview(){
          var title = $(".title").val();
          var description = $("textarea").val();
          document.getElementById("title").innerHTML = title;
          document.getElementById("description").innerHTML = description;
          $('.preview').hide();
          $('#blah').show();
          $('#title').show();
          $('#description').show();
        }
    </script>

   
  </body>
</html>