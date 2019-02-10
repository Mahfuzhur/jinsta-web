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

    <title>配信設定</title>
  </head>
  <body class="delivery_setting_page">
    <!-- top header -->

    <header>
      <div class="container-fluid">
        <div class="row top_fixed">
          <div class="header_left logo_top">
              <a href="index.html" class="logo_holder">
                <img src="{{asset('assets/img/logo.png')}}" alt="">
              </a>
          </div>
          <div class="header_right">
              <div class="user_area">
                <a class="dropdown_menu" href="#" role="button" id="" >
                  Taro Yamada
                  <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                </a>

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
                <a class="template" href="menuscript-reg.html">
                  <span class="sidebar_icon"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                  原稿登録
                </a>
                <a class="Plan" href="destination_registration.html">
                  <span class="sidebar_icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  宛先登録
                </a>
                <a class="Schedule" href="delivery_setting.html">
                  <span class="sidebar_icon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>
                  配信設定
                </a>
                <a class="Progress" href="analytics.html">
                  <span class="sidebar_icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></span>
                  アナリティクス
                </a>
                <a class="Summary" href="request.html">
                  <span class="sidebar_icon"><i class="fa fa-clone" aria-hidden="true"></i></span>
                  ご請求
                </a>
            </div>            
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12 delivery_setting">
                      <h4>宛先 & 原稿設定</h4>
                      <div class="dm_setting left-border m-b-40">                          
                          <div class="input_box">
                              <label for="destination">
                                  宛先
                              </label>
                              <select class="dest_input" id="destination" name="destination">
                                  <option value=""></option>
                                  <option value="">Template 1</option>
                                  <option value="">Template 2</option>
                                  <option value="">Template 3</option>
                                  <option value="">Template 4</option>
                              </select>                   
                          </div>
                          <div class="input_box">
                              <label for="draft">
                                  原稿
                              </label>
                              <select class="draft_input" id="draft" name="draft">
                                  <option value=""></option>
                                  <option value="">Draft 1</option>
                                  <option value="">Draft 2</option>
                                  <option value="">Draft 3</option>
                                  <option value="">Draft 4</option>
                              </select>                    
                          </div>
                      </div>
                      <div class="sc_settings left-border m-b-40">
                          <h4>スケジュール設定</h4>
                          <div class="input_box">
                              <label for="delivery_pr">配信期間
                              </label>
                              <div class="input_group">
                                  <div class="input-group">
                                    <input type="text" name="delivery_pr_start" id="delivery_pr_start" value="YYYY/MM/DD">
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                                  </div>                                  
                                  <span class="in_divider">~</span>
                                  <div class="input-group">
                                    <input id="delivery_pr_end" type="text" class="" name="delivery_pr_end" value="YYYY/MM/DD">
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                                  </div>
                              </div>                                               
                          </div>
                          <div class="input_box">
                              <label for="except_stting">配信期間
                              </label>
                              <div class="input_group">
                                  <div class="input-group">
                                    <input type="text" name="except_start" id="except_start" value="YYYY/MM/DD">
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                                  </div>                                  
                                  <span class="in_divider">~</span>
                                  <div class="input-group">
                                    <input id="except_end" type="text" class="" name="except_end" value="YYYY/MM/DD">
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                                  </div>
                              </div>                                               
                          </div>
                          <div class="input_box">
                              <label for="sp_time">時間指定
                              </label>
                              <div class="input_group">
                                  <div class="input-group">
                                    <input type="time" name="sp_time_start" id="sp_time_start" value="13:30">
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                                  </div>                                  
                                  <span class="in_divider">~</span>
                                  <div class="input-group">
                                    <input type="time" name="sp_time_end" id="sp_time_end" value="18:30">
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                                  </div>
                              </div>                                               
                          </div>
                          <div class="input_box">
                              <label for="sp_time">除外設定
                              </label>
                              <div class="input_group">
                                  <div class="input-group">
                                    <input type="time" name="ex_time_start" id="ex_time_start" value="06:30">
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                                  </div>                                  
                                  <span class="in_divider">~</span>
                                  <div class="input-group">
                                    <input type="time" name="ex_time_end" id="ex_time_end" value="10:30">
                                    <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                                  </div>
                              </div>                                               
                          </div>
                      </div>
                      <div class="left-border m-b-40">
                          <h4>1日当たりの想定送信回数 </h4>                          
                          <div class="input_box">
                              <h5 class="sent_times">2,370通</h5>                                                 
                          </div>
                          <div class="ds_btn_holder">
                            <button class="ds_btn">
                                設定する
                            </button>
                          </div>
                      </div>
                      
                  </div>

                  <div class="envelope_area">
                     <div class="envelope">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                     </div>
                  </div>
              </div>               
            </div>
        </div>
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
