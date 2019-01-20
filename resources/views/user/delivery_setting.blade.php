@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12 delivery_setting">
              <div class="dm_setting left-border m-b-40">
                  <h4>宛先｜原稿設定</h4>
                  <div class="input_box">
                      <label for="destination">
                          宛先
                      </label>
                      <select class="dest_input" id="destination" name="destination">
                          <option value=""></option>
                          <option value="">List 1</option>
                          <option value="">List 2</option>
                          <option value="">List 3</option>
                          <option value="">List 4</option>
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
                      <input type="text" name="delivery_pr_start" id="delivery_pr_start" value="YYYY/MM/DD">
                      <span class="in_divider">~</span>
                      <input type="text" name="delivery_pr_end" id="delivery_pr_end" value="YYYY/MM/DD">                                               
                  </div>
                  <div class="input_box">
                      <label for="except_stting">除外設定
                      </label>
                      <input type="text" name="except_start" id="except_start" value="YYYY/MM/DD">
                      <span class="in_divider">~</span>
                      <input type="text" name="except_end" id="except_end" value="YYYY/MM/DD">
                  </div>
                  <div class="input_box">
                      <label for="sp_time">
                        時間指定
                      </label>
                      <input type="time" name="sp_time_start" id="sp_time_start" value="13:30">
                      <span class="in_divider">~</span>
                      <input type="time" name="sp_time_end" id="sp_time_end" value="18:30">                                       
                  </div>
                  <div class="input_box">
                      <label for="ex_time">
                        除外設定
                      </label>
                      <input type="time" name="ex_time_start" id="ex_time_start" value="06:30">
                      <span class="in_divider">~</span>
                      <input type="time" name="ex_time_end" id="ex_time_end" value="10:30">
                    </div>
              </div>
              <div class="left-border m-b-40">
                  <h4>1日当たりの想定送信回数 </h4>                          
                  <div class="input_box">
                      <h5 class="sent_times">2,370通</h5>                                                 
                  </div>
              </div>
              <div class="ds_btn_holder">
                  <button class="ds_btn">
                      設定する
                  </button>
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

@endsection