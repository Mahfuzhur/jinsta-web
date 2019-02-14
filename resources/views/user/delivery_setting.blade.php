@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <form action="{{URL::to('set-schedule')}}"  method="post">
            {{csrf_field()}}
          <div class="col-md-12 delivery_setting">
              <h4>宛先 & 原稿設定</h4>
              @if(session('schedule_success'))
              <div class="alert alert-success">
                {{session('schedule_success')}}
              </div>
              @endif
              <div class="dm_setting left-border m-b-40">                          
                  <div class="input_box">
                      <label for="destination">
                          宛先
                      </label>
                      <select class="dest_input" id="destination" name="destination">
                          <option value="">SelectTemplate</option>
                           @foreach($templates as $template)
                            <option value="{{$template->id}}">{{$template->title}}</option>
                            @endforeach
                      </select>                   
                  </div>
                  <div class="input_box">
                      <label for="draft">
                          原稿
                      </label>
                      <select class="draft_input" id="draft" name="draft">
                          <option value="">Select Hashtag</option>
                           @foreach($hashtags as $hashtag)
                            <option value="{{$hashtag->id}}">{{$hashtag->hashtag}}</option>
                            @endforeach
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
                            <input type="text" name="delivery_period_start" id="delivery_pr_start" value="YYYY/MM/DD">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>                                  
                          <span class="in_divider">~</span>
                          <div class="input-group">
                            <input id="delivery_pr_end" type="text" class="" name="delivery_period_end" value="YYYY/MM/DD">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>
                      </div>                                               
                  </div>
                  <div class="input_box">
                      <label for="except_stting">配信期間
                      </label>
                      <div class="input_group">
                          <div class="input-group">
                            <input type="text" name="date_exclusion_setting_start" id="except_start" value="YYYY/MM/DD">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>                                  
                          <span class="in_divider">~</span>
                          <div class="input-group">
                            <input id="except_end" type="text" class="" name="date_exclusion_setting_end" value="YYYY/MM/DD">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>
                      </div>                                               
                  </div>
                  <div class="input_box">
                      <label for="sp_time">時間指定
                      </label>
                      <div class="input_group">
                          <div class="input-group">
                            <input type="time" name="specify_time_start" id="sp_time_start" value="13:30">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>                                  
                          <span class="in_divider">~</span>
                          <div class="input-group">
                            <input type="time" name="specify_time_end" id="sp_time_end" value="18:30">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>
                      </div>                                               
                  </div>
                  <div class="input_box">
                      <label for="sp_time">除外設定
                      </label>
                      <div class="input_group">
                          <div class="input-group">
                            <input type="time" name="time_exclusion_setting_start" id="ex_time_start" value="06:30">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>                                  
                          <span class="in_divider">~</span>
                          <div class="input-group">
                            <input type="time" name="time_exclusion_setting_end" id="ex_time_end" value="10:30">
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
                <a href="#">
                  <img src="{{asset('assets/img/message64.png')}}" alt="">
                </a>
             </div>
          </div>
      </div>  
      </form>             
    </div>
</div>
@endsection