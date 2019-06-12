@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
      <div class="row create_destination">            
        <div class="col-md-6 main_content">
            <!-- <div class="box_title">
                <h4>宛先名は削除でお願いします。</h4>
            </div> -->
            <!-- <form action="{{URL::to('hashtag-list-search')}}" method="post"> -->
            <form action="javascript:void(0);" method="post">
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
                        <input type="text" name="hashtag" id="hashtag"  value="宛先名： {{$compareHashtag->hashtag}}" class="hashtag_input" required="" style="border-radius: 2px;max-width: 415px;">
                        <input type="text" name="hashtag" id="hashtag"  value="送信対象者数: {{$compareHashtag->total_user}}" class="hashtag_input" required="" style="border-radius: 2px;max-width: 415px;">
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


<!--                <input type="checkbox" class="largerCheckbox"  id="yourBox" />-->
<!--                <label>Edit Hashtag</label><br>-->
<!--                <input readonly type="text" name="hashtag" style=" height: 45px; width: 413px; padding: 0.2em .5em;border: 1px solid #ffffff;" value="{{$compareHashtag->hashtag}}" id="yourText"  />-->



                @if(isset($new_hashtag))

                <input type="checkbox"   id="yourBox" />
                <label>Edit Hashtag</label><br>
                <input  type="text" name="updatedHashtag" id="yourText" disabled style=" height: 45px; width: 413px; padding: 0.2em .5em;border: 1px solid #ffffff;" value="{{$compareHashtag->hashtag}}"   />
                <input type="hidden" name="existingHashtag" value="{{$compareHashtag->hashtag}}">
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
        <div class="col-md-1" style="border-left: 2px solid #eae0e0;height: 520px"></div>
        <div class="col-md-5 main_content">

            <div id='loader' style='display: none;'>
              <div class="loader"> </div>
            </div>
            
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

    <script>
        document.getElementById('yourBox').onchange = function() {
            document.getElementById('yourText').disabled = !this.checked;
        };
    </script>
@endsection