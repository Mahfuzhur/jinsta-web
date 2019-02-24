@extend('master)
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 request">
              <!--<h4>原稿設定</h4>-->
              <!-- <div id="exTab1">
                <ul class="nav nav-pills">
                    <li>
                        <a href="#1a" data-toggle="tab">日</a>
                    </li>
                    <li>
                        <a href="#2a" data-toggle="tab">週</a>
                    </li>
                    <li>
                        <a class="show active" href="#3a" data-toggle="tab">月</a>
                    </li>                    
                </ul>
                <div class="tab-content">                    
                  <div class="tab-pane" id="1a">                    
                       <div class="dash_footer">
                            <span class="total">
                              <ul>
                                <li>送信回数：10000</li>
                                <li>送信単価：¥--</li>
                                <li>ご請求金額：¥---</li>
                            </ul>
                          </span>                             
                        </div>                      
                    </div>
                    <div class="tab-pane" id="2a">                      
                       <div class="dash_footer">
                            <span class="total">
                              <ul>
                                <li>送信回数：10000</li>
                                <li>送信単価：¥--</li>
                                <li>ご請求金額：¥---</li>
                            </ul>
                            </span>
                        </div>                      
                  </div>
                  <div class="tab-pane active" id="3a">                    
                       <div class="dash_footer">
                            <span class="total">
                              <ul>
                                <li>送信回数：10000</li>
                                <li>送信単価：¥--</li>
                                <li>ご請求金額：¥---</li>
                            </ul>
                            </span>
                      </div>                      
                    </div>
                </div>
              </div> -->
                <!--<div class="request_select">-->
                <!--    <div class="input_box">-->
                <!--      <label for="destination">-->
                <!--          宛先-->
                <!--      </label>-->
                <!--      <select class="dest_input" id="destination" name="destination">-->
                <!--          <option value=""></option>-->
                <!--          <option value="">Template 1</option>-->
                <!--          <option value="">Template 2</option>-->
                <!--          <option value="">Template 3</option>-->
                <!--          <option value="">Template 4</option>-->
                <!--      </select>                   -->
                <!--    </div>                 -->
                <!--</div>-->
                <div class="dash_footer">
                    <span class="total">
                        <ul>
                          <li><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""> </span>送信回数：{{$numberSent}}</li>
                          <li><span><img src="{{asset('assets/img/iconsshade333.png')}}" alt=""> </span> 送信単価：¥{{$numberSent*0.1}}</li>
                        </ul>
                        <!--<div class="last_request_list">-->
                        <!--  <p>ご請求金額：¥---</p>-->
                        <!--</div>-->
                    </span>                                                     
                </div>
                <!--<div class="request_upload">-->
                <!--    <div class="input_box">-->
                <!--        <label for="file">                          -->
                <!--            <span><i class="fa fa-download" aria-hidden="true"></i></span>-->
                <!--            <span>画像登録</span>                          -->
                <!--        </label>-->
                <!--        <input type="file" name="file[]" id="file" class="inputfile csv_input" data-multiple-caption="{count} files selected" multiple="">-->
                <!--    </div>-->
                <!--</div>-->
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
</div>
@endsection