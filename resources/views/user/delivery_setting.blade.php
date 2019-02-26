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
                      <label for="draft">
                          宛先
                      </label>
                      <select class="draft_input" id="draft" name="draft">
                          <option value="">原稿選択</option>
                          @foreach($hashtags as $hashtag)
                          <option value="{{$hashtag->id}}">{{$hashtag->hashtag}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="input_box">
                      <label for="destination">
                          原稿
                      </label>
                      <select class="dest_input" id="destination" name="destination">
                          <option value="">宛先選択</option>
                           @foreach($templates as $template)
                            <option value="{{$template->id}}">{{$template->title}}</option>
                            @endforeach
                      </select>                   
                  </div>


              </div>
              <div class="sc_settings left-border m-b-40">
                  <h4>スケジュール設定</h4>
                  <div class="input_box">
                      <label for="delivery_pr">配信期間<span class="msg_font">(期間を選択してください。)</span>
                      </label>
                      <div class="input_group">
                          <div class="input-group">
                            <input type="text" name="delivery_period_start" id="delivery_pr_start" value="YYYY/MM/DD" >
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
                      <label for="except_stting">除外期間<span class="msg_font">(期間を選択してください。)</span></label>
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
                      <label for="sp_time">時間指定<span class="msg_font">(時刻を選択してください。)</span>
                      </label>
                      <div class="input_group">
                          <div class="input-group">
                            <input type="time" name="specify_time_start" id="sp_time_start" value="">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>                                  
                          <span class="in_divider">~</span>
                          <div class="input-group">
                            <input type="time" name="specify_time_end" id="sp_time_end" value="" >
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>
                      </div>                                               
                  </div>
                  <div class="input_box">
                      <label for="sp_time">除外時間<span class="msg_font">(時刻を選択してください。)</span></label>
                      <div class="input_group">
                          <div class="input-group">
                            <input type="time" name="time_exclusion_setting_start" id="ex_time_start" value="" onchange="my_function();">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>                                  
                          <span class="in_divider">~</span>
                          <div class="input-group">
                            <input type="time" name="time_exclusion_setting_end" id="ex_time_end" value="" onchange="my_function();">
                            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>   
                          </div>
                      </div>                                               
                  </div>
              </div>
              <div class="left-border m-b-40">
                  <h4>1日当たりの想定送信回数 </h4>                          
                  <div class="input_box sent_count">
                      <h5 class="sent_times" id="sent_times">0通</h5>                                                 
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
<script type="text/javascript">
  function my_function(){
    var delivery_pr_start = document.getElementById("delivery_pr_start").value;
    var delivery_pr_end = document.getElementById("delivery_pr_end").value;
    var except_start = document.getElementById("except_start").value;
    var except_end = document.getElementById("except_end").value;

    var sp_time_start = document.getElementById("sp_time_start").value;
    var sp_time_end = document.getElementById("sp_time_end").value;
    var ex_time_start = document.getElementById("ex_time_start").value;
    var ex_time_end = document.getElementById("ex_time_end").value;

    // if(process(except_start) < process(delivery_pr_start) || process(except_start) > process(delivery_pr_end)){
    //   alert('Exclusion start date must be between above two dates');
    // }

    // if(process(except_end) < process(delivery_pr_start) || process(except_end) > process(delivery_pr_end)){
    //   alert('Exclusion start date must be between above two dates');
    // }

    // if(process(except_start) > process(except_end)){
    //   alert('Exclusion start date must be between smaller than exclusion end date');
    // }

    // function process(date){
    //    var parts = date.split("-");
    //    return new Date(parts[2], parts[1] - 1, parts[0]);
    // }

    // if(ex_time_start < sp_time_start || ex_time_start > sp_time_end){
    //   alert('Exclusion time must be between above two times');
    // }

    // if(ex_time_end < sp_time_start || ex_time_end > sp_time_end){
    //   alert('Exclusion time must be between above two times');
    // }

    // if(ex_time_start > ex_time_end){
    //   alert('Exclusion start time must be smaller than exclusion end time');
    // }

    
    var start_day = (process(delivery_pr_end) - process(delivery_pr_start))/(1000*60*60);
    var exclusion_day = (process(except_end) - process(except_start))/(1000*60*60);
    var remain_hour = (start_day - exclusion_day)/24;

    

    var start_time = moment.duration(sp_time_start, "HH:mm");
    var end_time = moment.duration(sp_time_end, "HH:mm");
    var difference = end_time.subtract(start_time);
    var hours = difference.hours() + ":" + difference.minutes();

    var ex_start_time = moment.duration(ex_time_start, "HH:mm");
    var ex_end_time = moment.duration(ex_time_end, "HH:mm");
    var difference1 = ex_end_time.subtract(ex_start_time);
    var ex_hours = difference1.hours() + ":" + difference1.minutes();

    var first_time = moment.duration(hours, "HH:mm");
    var second_time = moment.duration(ex_hours, "HH:mm");
    var final = first_time.subtract(second_time);
    var final_ex_hours = final.hours() + ":" + final.minutes();

    var final_minutes = final.minutes();
    var final_hour = (((final.hours() * remain_hour)*60)+(final_minutes*remain_hour));
    var total_hour = Math.ceil(final_hour/3);

    
    function process(date){
       var parts = date.split("-");
       return new Date(parts[2], parts[1] - 1, parts[0]);
    }
    if(total_hour){
      document.getElementById("sent_times").innerHTML = total_hour+"通";
    }
    
    // alert(total_hour);


    // var start_time = moment.duration(sp_time_start, "HH:mm");
    // var end_time = moment.duration(sp_time_end, "HH:mm");
    // var difference = end_time.subtract(start_time);
    // var hours = difference.hours() + ":" + difference.minutes();

    // var ex_start_time = moment.duration(ex_time_start, "HH:mm");
    // var ex_end_time = moment.duration(ex_time_end, "HH:mm");
    // var difference1 = ex_end_time.subtract(ex_start_time);
    // var ex_hours = difference1.hours() + ":" + difference1.minutes();

    // var final = hours.subtract(ex_hours);
    // var final_ex_hours = final.hours() + ":" + final.minutes();
      
    
  }
</script>
@endsection