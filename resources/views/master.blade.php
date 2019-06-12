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
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">-->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery  ui -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


    <title>
        @if(isset($title))
        {{$title}}
        @else
        Jinsta
        @endif</title>


<style type="text/css">


.load__none {
  display: none;  
  color:#fff;
}

.load__animation{
  border: 5px solid #06af94;
  border-top-color: #e50914;
  border-top-style: groove;
  height: 100px;
  width: 100px;
  border-radius: 100%;
  position: relative;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 1000;
  margin: auto;
  -webkit-animation: turn 1.5s linear infinite;
  -o-animation: turn 1.5s linear infinite;
  animation: turn 1.5s linear infinite;
}

.load {
  position: fixed;
  background: url('assets/img/preloader.png') no-repeat 50% fixed / cover;);
  width: 100%;
  height: 100vh;
  top: 0px;
  left: 0px;
  right: 0px;
  opacity: 0.8;
  display: flex;
  align-items:center;
  justify-content: center;
  z-index: 999;
}

.load__container {
  position: relative;
}

@keyframes turn {
  from {transform: rotate(0deg)}
  to {transform: rotate(360deg)}
} 

.load__title {
  color: #fff;
  font-size: 2rem;
}


@keyframes loadPage {
  0% {
    opacity: 1;
  }
  50% {
    opacity: .5;
  }
  100% {
    opacity: 1;
  }
  
}
</style>


    <script type="text/javascript">
        function schedule_action($id) {
            var id = $id;
            var token = $('meta[name="csrf-token"]').attr('content');
            // console.log(id);
            jQuery.ajax({
                type: "POST",
                url: "{{URL::to('schedule-action')}}",
                data: {
                    "_method": 'POST',
                    "_token": token,
                    "id": id
                },
                success: function (response) {

                  $('#ajax_schedule_list').html(response);

                    // if (response.data === 'stop') {
                    //     // alert('schedule stop');
                    //     jQuery('#schedule_stop' + response.id).hide();
                    //     jQuery('#schedule_start' + response.id).show();
                    // } 
                    // else if (response.data === 'start') {
                    //     // alert('schedule start');
                    //     jQuery('#schedule_start' + response.id).hide();
                    //     jQuery('#schedule_stop' + response.id).show();
                    // }

                }
            });
        }

        function schedule_expire_alert(){
          alert('このスケジュールは期限切れです');
        }
    </script>
    <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(images/loader-64x/Preloader_2.gif) center no-repeat #fff;
        }
    </style>
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
                    <ul class="dropdown_menu">
                        <li> {{Auth::user()->name}}
                            <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                            <ul class="dropdown-item-holder">
                                <li>
                                    <a class="dropdown-item" href="{{URL::to('dashboard')}}">ダッシュボード</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
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
            @if(isset($schedule_list))
            <a class="Summary active" href="{{URL::to('schedule-list')}}">
                <span class="sidebar_icon"><img src="{{asset('assets/img/sc.png')}}" alt=""></span>
                スケジュールリスト
            </a>
            @else
            <a class="Summary" href="{{URL::to('schedule-list')}}">
                <span class="sidebar_icon"><img src="{{asset('assets/img/sc.png')}}" alt=""></span>
                スケジュールリスト
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
            @if(isset($request))
            <a class="Summary active" href="{{URL::to('request')}}">
                <span class="sidebar_icon"><img src="{{asset('assets/img/payment.png')}}" alt=""></span>
                ご請求
            </a>
            @else
            <a class="Summary" href="{{URL::to('request')}}">
                <span class="sidebar_icon"><img src="{{asset('assets/img/payment.png')}}" alt=""></span>
                ご請求
            </a>
            @endif

<!--            @if(isset($active_hashstag_compare))-->
<!--                <a class="Plan active" href="{{URL::to('compare-hashtag')}}">-->
<!--                  <span class="sidebar_icon"><img src="{{asset('assets/img/person.png')}}" alt=""></span>-->
<!--                    お試しリスト-->
<!--                </a>-->
<!--              @else-->
<!--                <a class="Plan" href="{{URL::to('compare-hashtag')}}">-->
<!--                  <span class="sidebar_icon"><img src="{{asset('assets/img/person.png')}}" alt=""></span>-->
<!--                    お試しリスト-->
<!--                </a>-->
<!--              @endif-->


        </div>

        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        
          <!-- /#page-content-wrapper -->
      </div>

        @yield('user_main_content')

      </div>
    <!-- jquery core -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- bootstrap js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- custom js -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    @if(isset($added_date))
      @if($added_date < $today && $company_info->account_status == 1)
      <script type="text/javascript">
        $(document).ready(function(){
              // $(".show-modal").click(function(){
              $("#myModal").modal({
                  backdrop: 'static',
                  keyboard: false
              });
          // });
        });
      </script>
      @endif
      @endif
    <script>

        

        $(document).ready(function(){

        /* hashtag list serach start*/
 
         $("#but_search").click(function(){
          var hashtag = $('#hashtag').val();

          $.ajax({
           url: "{{url('hashtag-list-search')}}",
           type: "post",
           data: {"_token": "{{ csrf_token() }}","hashtag":hashtag},
           beforeSend: function(){
            // Show image container
            console.log(hashtag);
            $("#Load").show();
           },
           success: function(response){
            console.log(response.data);
            if(response.data == 1){
              $('#exception_msg').html(response.insta_credential_err);
            }else if(response.data == 2){
              $('#exception_msg').html(response.no_hashtag_err);
            }
            else{
              $('#page-content-wrapper').html(response);
            }
           },
           complete:function(data){
            // Hide image container
            $("#Load").hide();
           }
          });
         
         });

        /* hashtag list serach end*/

        
        /* compare hashtag list serach start*/

         $("#but_search_hashtag").click(function(){
          var hashtag = $('#hashtags').val();
          var flag = $('#flag').val();
          var compareHashtag = $('#compareHashtag').val();

          console.log(hashtag);

          $.ajax({
           url: "{{url('hashtag-list-search')}}",
           type: "post",
           data: {"_token": "{{ csrf_token() }}","hashtag":hashtag,"flag":flag,"compareHashtag":compareHashtag},
           beforeSend: function(){
            // Show image container
            console.log(hashtag);
            $("#Load").show();
           },
           success: function(response){
            
            if(response.data == 1){
              $('#exception_msg').html(response.insta_credential_err);
            }else if(response.data == 2){
              $('#exception_msg').html(response.no_hashtag_err);
            }
            else{
              $('#page-content-wrapper').html(response);
            }
           },
           complete:function(data){
            // Hide image container
            $("#Load").hide();
           }
          });
         
         });

         /* compare hashtag list serach end*/

        });

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
        var description = $("textarea").val();
        // document.getElementById("title").innerHTML = title;
        document.getElementById("description").innerHTML = description;
        $('#description').show();
        $('.image_show').after('<img id="blah" src="#" alt="your image" />');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(200);
                document.getElementById('image_show_small').src = e.target.result;
                document.getElementById('no_image_id').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readimageURL(input) {
        $('.preview').show();
        $('#blah').hide();
        // $('#title').hide();
        var description = $("textarea").val();
        // document.getElementById("title").innerHTML = title;
        document.getElementById("description").innerHTML = description;
        $('#description').show();
        $('.image_show').after('<img id="blah" src="#" alt="your image"/>');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(200);
                document.getElementById('no_image_id').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


    function getPreview() {
        var title = $(".title").val();
        var description = $("textarea").val();
        // document.getElementById("title").innerHTML = title;
        document.getElementById("description").innerHTML = description;
        $('.preview').show();
        $('#blah').show();
        // $('#title').show();
        $('#description').show();
    }


    function confirm_click() {

        var check = confirm('Are you sure to delete this?');
        if (check) {
            return true;
        } else {
            return false;
        }
    }

    function delete_schedule() {

        var check = confirm('配信リストを削除します。よろしいですか？');
        if (check) {
            return true;
        } else {
            return false;
        }
    }

</script>
<script>
    function myFunction() {
        Swal.mixin({
            input: 'text',
            confirmButtonText: 'Next &rarr;',
            showCancelButton: true,
            progressSteps: ['1', '2', '3']
        }).queue([
            {
                title: 'Question 1',
                text: 'Chaining swal2 modals is easy'
            },
            'Question 2',
            'Question 3'
        ]).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: 'All done!',
                    html:
                        'Your answers: <pre><code>' +
                        JSON.stringify(result.value) +
                        '</code></pre>',
                    confirmButtonText: 'Lovely!'
                })
            }
        })


    }
</script>


</body>
</html>
