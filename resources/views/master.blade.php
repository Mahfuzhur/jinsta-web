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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <title>
    @if(isset($title))
    {{$title}}
    @else
    Jinsta
    @endif
  </title>
  </head>
  <body>
    <!-- top header -->

    <header>
      <div class="container-fluid">
        <div class="row top_fixed">
          <div class="header_left logo_top">
            <h4>
              <a href="{{URL::to('dashboard')}}">
                <span class="logo_sec">LOGO</span>
              </a>
            </h4>
          </div>
          <div class="header_right">
               <img class="user_img" src="{{asset('assets/img/user.png')}}">
                                                                 
                <a class="btn btn-primary btn-sm pull-right" style="margin: 6px;" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                                                               
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
                <a class="template active" href="{{URL::to('manuscript-registration')}}">原稿登録</a>
              @else
                <a class="template" href="{{URL::to('manuscript-registration')}}">原稿登録</a>
              @endif
              @if(isset($active_destination))
                <a class="Plan active" href="{{URL::to('destination-registration')}}">宛先登録</a>
              @else
                <a class="Plan" href="{{URL::to('destination-registration')}}">宛先登録</a>
              @endif
              @if(isset($delivery_setting))
              <a class="Schedule active" href="{{URL::to('delivery-setting')}}">配信設定</a>
              @else
              <a class="Schedule" href="{{URL::to('delivery-setting')}}">配信設定</a>
              @endif
              @if(isset($analytics))
              <a class="Progress active" href="{{URL::to('analytics')}}">アナリティクス</a>
              @else
              <a class="Progress" href="{{URL::to('analytics')}}">アナリティクス</a>
              @endif
              @if(isset($request))
              <a class="Summary active" href="{{URL::to('request')}}">ご請求</a>
              @else
              <a class="Summary" href="{{URL::to('request')}}">ご請求</a>
              @endif
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
          $("#delivery_pr_start").datepicker({ dateFormat: 'yy-mm-  dd' });
        $("#delivery_pr_end").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#except_start").datepicker({ dateFormat: 'yy-mm-dd'    });
        $("#except_end").datepicker({ dateFormat: 'yy-mm-dd'    });
      });
    </script>

   
  </body>
</html>
