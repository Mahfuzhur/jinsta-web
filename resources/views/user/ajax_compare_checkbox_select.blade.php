
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

            <div class="alert alert-success" id="show_compare_hashtag_message" style="display: none;"></div>

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
            <div class="hashtag_title left-border m-b-40">
                <div class="input_box">                    
                    <div class="input-group"> 
                        <form action="{{URL::to('hashtag-list-search')}}" method="post">
                            {{csrf_field()}}
                            <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
                            <input type="text" name="hashtag" id="hashtags"  placeholder="Tokyo" class="hashtag_input" required="">
                            <input type="hidden" id="flag" name="flag" value="1">
                            <input type="hidden" id="compareHashtag" name="compareHashtag" value="{{$compareHashtag}}">

                            <div class="input-group-append" style="margin-left: -10px;">
                                <button type="button" name="" id="but_search_hashtag" class="btn btn-info" style="background: #06af94;">Search</button>
                                <!-- <span class="input-group-text" id="">Search</span> -->
                            </div>
                        </form>

                    </div>                   
                </div>
            </div>
            </form>


            <form action="{{URL::to('save-new-hashtag')}}" method="post">
                {{csrf_field()}}

                <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
                

                @if(isset($new_hashtag))
                <input type="checkbox" class="largerCheckbox"  id="yourBox" />
                <label>Edit Hashtag</label><br>
                <input  type="text" name="updatedHashtag" id="yourText" disabled style=" height: 45px; width: 413px; padding: 0.2em .5em;border: 1px solid #ffffff;" value=""   />
                <input type="hidden" name="existingHashtag" id="existingHashtag" value="{{$compareHashtag->hashtag}}">
                
                <input type="hidden" name="firstHashtagId" id="firstHashtagId" value="{{$compareHashtag->id}}">
                @foreach($new_hashtag as $key => $new_hashtag)
                <input type="hidden" name="newHashtag[]" id="newHashtag_{{$key}}" value="{{$new_hashtag}}">
                @endforeach
                <div class="form_buttons">
                    <button type="button" id="final_hashtag_save" class="btn_done p_btn">除外リストを保存</button>
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
                                <input type="radio" name="hashtag_list" value="{{$result->name}}" required=""><br>
                                <input type="hidden" name="compareHashtag" value="{{$compareHashtag}}">
                                <input type="hidden" name="flag" value="1">
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
                    <button type="sybmit" class="btn_done p_btn">登録</button>
                </div>
                @endif



            </form>
        </div>


    </div>


</div>

<script type="text/javascript">
    /* compare hashtag list serach start*/

         $("#final_hashtag_save").click(function(){
          // var hashtag = $('#hashtag_name').val();

          var updatedHashtag = $('#yourText').val();
          var existingHashtag = $('#existingHashtag').val();
          
          var firstHashtagId = $('#firstHashtagId').val();
          var newHashtag = hashTagValue($('input[name="newHashtag[]"]'));
          console.log(hashTagValue($('input[name="newHashtag[]"]')));
          
          $.ajax({
           url: "{{url('save-new-hashtag')}}",
           type: "post",
           data: {"_token": "{{ csrf_token() }}","updatedHashtag":updatedHashtag,"existingHashtag":existingHashtag,"firstHashtagId":firstHashtagId,"newHashtag":newHashtag},
           beforeSend: function(){
            // Show image container
            // console.log(hashtag);
            // console.log(secondHashtagId);
            console.log(updatedHashtag);
            console.log(existingHashtag);
            $("#Load").show();
           },
           success: function(response){
            $('#show_compare_hashtag_message').show();
            $('#show_compare_hashtag_message').html(response.data);
           },
           complete:function(data){
            // Hide image container
            $("#Load").hide();
           }
          });
         
         });
         /* compare hashtag list serach end*/
         function hashTagValue(inputs) {
            if (!inputs instanceof Array) {
                return [];
            }

            let serialValue = inputs.serializeArray();

            return Object.keys(serialValue).map(function(key) {
              return serialValue[key].value;
            });
         }
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
    <script>
        document.getElementById('yourBox').onchange = function() {
            document.getElementById('yourText').disabled = !this.checked;
        };
    </script>
