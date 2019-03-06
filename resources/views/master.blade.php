<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- bootstrap css -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> 
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery  ui -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>

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
        <div class="row top_fixed" >
          <div class="header_left logo_top">
              <a href="{{URL::to('dashboard')}}" class="logo_holder">
                <img src="{{asset('assets/img/logo.png')}}" alt="">
              </a>
          </div>
          <div class="header_right">
              <div class="user_area">
                <ul class="dropdown_menu">
                  <li > {{Auth::user()->name}}
                    <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                    <ul class="dropdown-item-holder">
                        <li>
                        <a class="dropdown-item" href="{{URL::to('dashboard')}}">Dashboard</a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">Logout</a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>                  
                    </ul>
                    </li>
                  </ul>                             
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
                  <span class="sidebar_icon"><img src="{{asset('assets/img/send.png')}}" alt=""></span>
                  原稿登録
                </a>
              @else
                <a class="template" href="{{URL::to('manuscript-registration')}}">
                  <span class="sidebar_icon"><img src="{{asset('assets/img/send.png')}}" alt=""></span>
                  原稿登録
                </a>
              @endif
              @if(isset($active_destination))
                <a class="Plan active" href="{{URL::to('destination-registration')}}">
                  <span class="sidebar_icon"><img src="{{asset('assets/img/person.png')}}" alt=""></span>
                  宛先登録
                </a>
              @else
                <a class="Plan" href="{{URL::to('destination-registration')}}">
                  <span class="sidebar_icon"><img src="{{asset('assets/img/person.png')}}" alt=""></span>
                  宛先登録
                </a>
              @endif
              @if(isset($delivery_setting))
                <a class="Schedule active" href="{{URL::to('delivery-setting')}}">
                  <span class="sidebar_icon"><img src="{{asset('assets/img/calandersetting.png')}}" alt=""></span>
                  配信設定
                </a>
              @else
              <a class="Schedule" href="{{URL::to('delivery-setting')}}">
                  <span class="sidebar_icon"><img src="{{asset('assets/img/calandersetting.png')}}" alt=""></span>
                  配信設定
                  </a>
              @endif
              @if(isset($analytics))
                <a class="Progress active" href="{{URL::to('analytics')}}">
                  <span class="sidebar_icon"><img src="{{asset('assets/img/analytics.png')}}" alt=""></span>
                  アナリティクス
                </a>
              @else
              <a class="Progress" href="{{URL::to('analytics')}}">
                  <span class="sidebar_icon"><img src="{{asset('assets/img/analytics.png')}}" alt=""></span>
                  アナリティクス
                </a>
              @endif
                <a class="Summary" href="{{URL::to('request')}}">
                  <span class="sidebar_icon"><img src="{{asset('assets/img/payment.png')}}" alt=""></span>
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

      // $(document).ready(function(){
 
      //    $("#but_search").click(function(){
      //     var search = $('#hashtag').val();
      //     var token = $('meta[name="csrf-token"]').attr('content');
      //     // console.log(token);

      //     jQuery.ajax({
      //       type: "POST",
      //       url: "{{URL::to('hashtag-list-search')}}",
      //       data: {
      //       "_method": 'POST',
      //       "_token": token,
      //       "search": search,
      //       },
      //      dataType: 'html',
           
      //      beforeSend: function(){
      //       // Show image container
      //       $("#loader").show();
      //      },
      //      success: function(response){
      //       if(response.success){
      //         $('.hashtag_search_alert').html(result.success);
      //       }else{
      //         $('.response').empty();
      //         $('.response').append(response);
      //       }
            
      //      },
      //      complete:function(data){
      //       // Hide image container
      //       $("#loader").hide();
      //      }
      //     });
         
      //    });
      //   });
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
          // $('#title').hide();
          $('#description').hide();
          $('.image_show').after('<img id="blah" src="#" alt="your image" style="display:none;"/>');
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#blah')
              .attr('src', e.target.result)
              .width(250)
              .height(200);
              document.getElementById('image_show_small').src =  e.target.result;
              document.getElementById('no_image_id').src =  e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
          }
        }

        function readimageURL(input) { 
        $('.preview').show();
          $('#blah').hide();
          // $('#title').hide();
          $('#description').hide();
          $('.image_show').after('<img id="blah" src="#" alt="your image" style="display:none;"/>');
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#blah')
              .attr('src', e.target.result)
              .width(250)
              .height(200);
              document.getElementById('no_image_id').src =  e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
          }
        }

        function getPreview(){
          var title = $(".title").val();
          var description = $("textarea").val();
          // document.getElementById("title").innerHTML = title;
          document.getElementById("description").innerHTML = description;
          $('.preview').show();
          $('#blah').show();
          // $('#title').show();
          $('#description').show();
        }

            function confirm_click(){

                var check = confirm('Are you sure to delete this?');
                if(check){
                    return true;
                }else{
                    return false;
                }
            }
        
    </script>

   
  </body>
</html>
