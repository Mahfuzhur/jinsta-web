
<div id="page-content-wrapper">
    <div class="container-fluid">
      <div class="row create_destination">            
        <div class="col-md-6 main_content">
            <!-- <div class="box_title">
                <h4>宛先名は削除でお願いします。</h4>
            </div> -->
            <form action="{{URL::to('hashtag-list-search')}}" method="post">
            {{csrf_field()}}
            <!-- <div id='loader' style='display: none;'>
              <img src="{{asset('assets/img/progressbar2.gif')}}">
            </div> -->
            <div id="Load" class="load" style="display: none;">
              <div class="load__container">
                <div class="load__animation"></div>
                <div class="load__mask"></div>
                <span class="load__title">リクエスト中です。ブラウザを閉じないでください。</span>
              </div>
            </div>

            <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
            <h4>配信詳細設定</h4>
            <div class="hashtag_title left-border m-b-40">
                <div class="input_box">

                    <div class="input-group">
                        <input type="text" name="hashtag" id="hashtag"  value="宛先名： {{$compareHashtag->hashtag}}" class="hashtag_input" required="" style="border-radius: 2px;max-width: 420px;">
                        <input type="text" name="hashtag" id="hashtag"  value="送信対象者数: {{$compareHashtag->total_user}}" class="hashtag_input" required="" style="border-radius: 2px;max-width: 420px;">
                    </div>                   
                </div>
            </div>
            <h4>除外ハッシュタグ</h4>
            <h5 id="exception_msg" style="color: red;"></h5>
            <div class="hashtag_title left-border m-b-40">
                <div class="input_box">                    
                    <div class="input-group"> 
                        <form action="{{URL::to('hashtag-list-search')}}" method="post">
                            {{csrf_field()}}
                            <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
                            <input type="text" name="hashtag" id="hashtag_ajax"  placeholder="Tokyo" class="hashtag_input" required="">
                            <input type="hidden" name="flag" value="1">
                            <input type="hidden" name="compareHashtag" value="{{$compareHashtag}}">

                            <div class="input-group-append" style="margin-left: -10px;">
                                <button type="button" name="" id="ajax_but_search_hashtag" class="btn btn-info" style="background: #06af94;">Search</button>
                                <!-- <span class="input-group-text" id="">Search</span> -->
                            </div>
                        </form>

                    </div>                   
                </div>
            </div>
            </form>


            <form action="{{URL::to('save-new-hashtag')}}" method="post">
                {{csrf_field()}}

                
                

                @if(isset($lastInsertId))
                <input type="checkbox" class="largerCheckbox"  id="yourBox" />
                <label>Edit Hashtag</label><br>
                <input readonly type="text" name="hashtag"  value="{{$compareHashtag->hashtag}}" id="yourText"  />
                <input type="hidden" name="secondHashtagId" value="{{$lastInsertId}}">
                <input type="hidden" name="firstHashtagId" value="{{$compareHashtag->id}}">
                @foreach($new_hashtag as $new_hashtag)
                <input type="hidden" name="newHashtag[]" value="{{$new_hashtag}}">
                @endforeach
                <div class="form_buttons">
                    <button type="sybmit" class="btn_done p_btn">除外リストを保存</button>
                </div>
                @endif

            </form>
            
        </div>
        <div class="col-md-1" style="border-left: 2px solid #eae0e0;"></div>
        <div class="col-md-5 main_content">
            
            <!-- <div class="box_title">
                <h4>宛先名は削除でお願いします。</h4>
            </div> -->
            
            <!-- <div class='response'></div> -->
            <form action="{{URL::to('hashtag-list-search-csv')}}" method="post">
                {{csrf_field()}}
                <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
                <div class="radio_list_area">
                    @if(isset($results))
                    <div class="radio_label">
                        <h3>Select List</h3>
                    </div>
                    <div class="radio_list">
                        <div class="single_radio radio1">
                            <?php $i=0;?>
                            @foreach($results as $result)
                            @if($i < 9)
                            <label class="checkcontainer" style="width: 50%;"> {{$result->name}}-> {{$result->search_result_subtitle}}
                                <input type="radio" name="ajax_compare_hashtag_list" id="ajax_compare_hashtag_list"value="{{$result->name}}" required=""><br>
                                <input type="hidden" id="compareHashtag" name="compareHashtag" value="{{$compareHashtag}}">
                                <input type="hidden" id="flag" name="flag" value="1">
                                <span class="radiobtn"></span>
                            </label>
                            @endif
                            <?php $i++;?>
                            @endforeach

                        </div>

                    </div>
                </div>

                <div class="form_buttons">
                    <!-- <button class="btn_cancel p_btn">削除する</button> -->
                    <button type="button" id="ajax_compare_hashtag_save" class="btn_done p_btn">登録</button>
                </div>
                @endif



            </form>
        </div>


    </div>


</div>
    <script>

        /* compare hashtag list serach start*/

         $("#ajax_but_search_hashtag").click(function(){
          var hashtag = $('#hashtag_ajax').val();
          var flag = $('#flag').val();
          var compareHashtag = $('#compareHashtag').val();

          console.log(hashtag);
          console.log(flag);

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

         /* compare hashtag list serach save start*/

        $("#ajax_compare_hashtag_save").click(function(){
            
          // var hashtag_list = $('#hashtag_list').val();
          var hashtag_list = $("input[name='ajax_compare_hashtag_list']:checked"). val();
          var flag = $('#flag').val();
          var compareHashtag = $('#compareHashtag').val();
          console.log(hashtag_list);

          $.ajax({
           url: "{{url('hashtag-list-search-csv')}}",
           type: "post",
           data: {"_token": "{{ csrf_token() }}","hashtag_list":hashtag_list,"flag":flag,"compareHashtag":compareHashtag},
           beforeSend: function(){
            // Show image container
            console.log(hashtag_list);
            console.log(flag);
            $("#Load").show();
           },
           success: function(response){
            $("#Load").hide();
            
            // if(response.flag === 1){
            //     $("#hashtag_session_save").show();
            //     $("#hashtag_session_save").html(response.data);
            // }else(){
            //     $('.ajax_hashtag_list').html(response);
            // }
            $('#page-content-wrapper').html(response);
            // Session["message"]=response.data;
            // window.location = "{{URL::to('create-destination')}}";
           },
           complete:function(data){
            // Hide image container
            $("#Load").hide();
           }
          });
         
         });
        /* compare hashtag list serach save end*/
         
        // document.getElementById('yourBox').onchange = function() {
        // document.getElementById('yourText').readOnly = false;
        // };
    </script>

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
