@extend('master')
@section('user_main_content')
<div id="page-content-wrapper"> 

<!-- <input type="button" class="btn btn-lg btn-primary show-modal" value="Show Demo Modal"> -->
    
    <!-- Modal HTML -->
    <form action="{{URL::to('save-user-extra-information')}}" method="post">
      {{csrf_field()}}
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <h4 class="modal-title"><span style="color: red;">Trial Expired !!</span> Please fill up the Billing Contact information</h4><br>
                </div>
                <div class="modal-body">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="お名前" required="">
                  </div>
                  <div class="form-group">
                    <input type="text" name="company_name" class="form-control" placeholder="ご担当部署" required="">
                  </div>
                    <div class="form-group">
                        <input type="text" name="contact_number" class="form-control" placeholder="電話番号" required="">
                    </div>
                    <div class="form-group">
                        <input type="text" name="street" class="form-control" placeholder="住所" required="">
                    </div>
                    <div class="form-group">
                        <input type="text" name="postal_code" class="form-control" placeholder="郵便番号" required="">
                    </div>
                    <!-- <p>Do you want to save changes you made to document before closing?</p>
                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p> -->
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">Cancel</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div> 
  </form>      

  <div class="container-fluid">
    <div class="row row-eq-height">
      <div class="col-md-6 col-sm-12">
        @if(Session('user_extra_info'))
        <div class="alert alert-success">
            <p> {{Session('user_extra_info')}} &#10004; </p>
        </div>
        @endif
          <div class="test_section">
            @if(!isset($json_selfinfo['message']))
             <center><img class="test_img" src="{{$json_selfinfo['user']['profile_pic_url']}}"></center>
              <div class="test"><center>{{$json_selfinfo['user']['username']}}</center></div>
            @else
            <div class="test"><center style="color: #c32727;font-size: 20px;text-align: justify !important; padding: 20px;">*このメッセージは、テンプレートを送信できないことを示しています。

              2要素認証をオフにして、[設定]の[プライバシーとセキュリティ]オプションで自分のプロファイルを公開してください。

              ここであなたのInstagramの資格情報を更新する <a href="{{URL::to('update-instagram-info')}}" style="color: #06af94;">Update</a></center></div>
            @endif
<!--             <div class="row inst_section">-->
<!--                <div class="inst_title first">-->
<!--                   <h4 class="instagram">Instagram</h4>                              -->
<!--                </div>-->
<!--                <div class="inst_title second">-->
<!--                   <h4><i class="fa fa-check-circle-o"></i> どうして </h4>                            -->
<!--                </div>-->
<!--                <div class="inst_content">-->
<!--                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus nisi tincidunt, eleifend nibh nec, suscipit arcu. Curabitur facilisis elit sed pellentesque volutpat. Suspendisse molestie, justo sit amet.</p>-->
<!--                </div>-->
<!--             </div>-->
<!---->
<!--             <div class="jp_language">-->
<!--                <span>どうして</span>-->
<!--             </div>-->
<!--              <div class="clasa">-->
<!--                  <div class="inst_content">-->
<!--                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus nisi tincidunt, eleifend nibh nec, suscipit arcu. Curabitur facilisis elit sed pellentesque volutpat. Suspendisse molestie, justo sit.</p>-->
<!--                  </div>-->
<!--              </div>                       -->
          </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div id="exTab1" class="m-t-25">
          <ul class="nav nav-pills">
              <li>
                  <a href="#1a" data-toggle="tab">日</a>
              </li>
              <li class="active">
                  <a href="#2a" data-toggle="tab">週</a>
              </li>
              <li>
                  <a class="show active" href="#3a" data-toggle="tab">月</a>
              </li>                    
          </ul>
          <div class="tab-content">                    
            <div class="tab-pane" id="1a">
                <h3 class="pro_info"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>ダッシュボード</h3><br>
                  <!-- <div class="row progress_vertical_holder">
                    <div class="progress_vertical">                                
                       <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="height: 30%;">
                            <span class="sr-only">30% Complete</span>
                          </div>
                        </div>
                        <p>Apr</p>
                      </div>
                      <div class="progress_vertical"> 
                        <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 60%;">
                            <span class="sr-only">60% Complete</span>
                          </div>
                        </div>
                         <p>May</p>
                      </div>
                      <div class="progress_vertical"> 
                          <div class="progress progress-bar-vertical">                                    
                            <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 100%;">
                              <span class="sr-only">60% Complete</span>                                      
                            </div>                                    
                          </div>
                           <p>Jun</p>
                      </div>
                        <div class="progress_vertical">                                  
                          <div class="progress progress-bar-vertical">
                            <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 100%;">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                           <p>Jul</p>
                        </div>
                      <div class="progress_vertical"> 
                        <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 70%;">
                            <span class="sr-only">70% Complete</span>
                          </div>
                        </div>
                         <p>Aug</p>                                 
                      </div>
                      <div class="progress_vertical"> 
                        <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 60%;">
                            <span class="sr-only">60% Complete</span>
                          </div>
                        </div>
                         <p>Sep</p>                                 
                    </div>
                 </div>  -->
                 <div class="dash_footer">
                    <span class="total"><b>送信数 : {{$last_day}}</b></span> <br>
                    <!-- <span class="total"><b>既読数 </br> 1,000 </b></span> <br>
                    <span class="total"><b> 既読率 </br>1% </b></span> -->
                </div>
            </div>
            <div class="tab-pane" id="2a">
                <h3 class="pro_info"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>ダッシュボード</h3><br>
                <!-- <div class="row progress_vertical_holder">
                    <div class="progress_vertical">                                
                       <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="height: 30%;">
                            <span class="sr-only">30% Complete</span>
                          </div>
                        </div>
                        <p>Apr</p>
                      </div>
                      <div class="progress_vertical"> 
                        <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 60%;">
                            <span class="sr-only">60% Complete</span>
                          </div>
                        </div>
                         <p>May</p>
                      </div>
                      <div class="progress_vertical"> 
                          <div class="progress progress-bar-vertical">                                    
                            <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 100%;">
                              <span class="sr-only">60% Complete</span>                                      
                            </div>                                    
                          </div>
                           <p>Jun</p>
                      </div>
                        <div class="progress_vertical">                                  
                          <div class="progress progress-bar-vertical">
                            <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 100%;">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                           <p>Jul</p>
                        </div>
                      <div class="progress_vertical"> 
                        <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 70%;">
                            <span class="sr-only">70% Complete</span>
                          </div>
                        </div>
                         <p>Aug</p>                                 
                      </div>
                      <div class="progress_vertical"> 
                        <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 60%;">
                            <span class="sr-only">60% Complete</span>
                          </div>
                        </div>
                         <p>Sep</p>                                 
                    </div>
                 </div>  -->                  
                 <div class="dash_footer">
                    <span class="total"><b>送信数 : {{$last_week}}</b></span> <br>
                    <!-- <span class="total"><b>既読数 </br> 1,000 </b></span> <br>
                    <span class="total"><b> 既読率 </br> 1% </b></span> -->
                </div>                      
          </div>
          <div class="tab-pane active" id="3a">
                <h3 class="pro_info"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>ダッシュボード</h3><br>
                <!-- <div class="row progress_vertical_holder">
                    <div class="progress_vertical">                                
                       <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="height: 30%;">
                            <span class="sr-only">30% Complete</span>
                          </div>
                        </div>
                        <p>Apr</p>
                      </div>
                      <div class="progress_vertical"> 
                        <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="height: 60%;">
                            <span class="sr-only">60% Complete</span>
                          </div>
                        </div>
                         <p>May</p>
                      </div>
                      <div class="progress_vertical"> 
                          <div class="progress progress-bar-vertical">                                    
                            <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 100%;">
                              <span class="sr-only">60% Complete</span>                                      
                            </div>                                    
                          </div>
                           <p>Jun</p>
                      </div>
                        <div class="progress_vertical">                                  
                          <div class="progress progress-bar-vertical">
                            <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 100%;">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                           <p>Jul</p>
                        </div>
                      <div class="progress_vertical"> 
                        <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 70%;">
                            <span class="sr-only">70% Complete</span>
                          </div>
                        </div>
                         <p>Aug</p>                                 
                      </div>
                      <div class="progress_vertical"> 
                        <div class="progress progress-bar-vertical">
                          <div class="progress-bar progress_color active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 60%;">
                            <span class="sr-only">60% Complete</span>
                          </div>
                        </div>
                         <p>Sep</p>                                 
                    </div>
                 </div> -->                     
                 <div class="dash_footer">
                    <span class="total"><b>送信数 : {{$last_month}}</b></span> <br>
                    <!-- <span class="total"><b>既読数 <br> 1,000</b></span> <br>
                    <span class="total"><b>既読率 <br> 1%</b></span> -->
                </div>                      
            </div>
          </div>
        </div>
        <div class="progress_view m-t-30">

           <h4 class="progress_margin"><span><img src="{{asset('assets/img/iconsshade333.png')}}" alt=""></span> 進行ステータス</h4>
           @if(isset($data_info))
           @foreach($data_info['dm_sent'] as $data )
            @foreach($data_info['without_dm_sent'] as $without_data )                     
            @if($data->hashtag_name == $without_data->hashtag_id)
              <div class="row progressbar_holder">
                <div class="progress_title">
                   <span class="hashtag">#{{str_limit($data->hashtag, $limit = 10, $end = '..')}}</span>
                   <span class="letter">{{str_limit($data->title, $limit = 10, $end = '..')}}</span>
                </div>                        

                <div class="progress_size">
                   <div class="progress">
                      <div class="progress-bar progress_color" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:{{floor($data->total_sent*100/$without_data->total_row)}}%; min-width: 20px;">{{floor($data->total_sent*100/$without_data->total_row)}}%
                      </div>
                   </div>
                </div>  
             </div>
             @endif
              @endforeach
             @endforeach
             @endif
             <!-- <div class="row progressbar_holder">
                <div class="progress_title">
                   <span class="hashtag">#〇〇</span>
                   <span class="letter">A</span>
                </div>                        

                <div class="progress_size">
                   <div class="progress">
                      <div class="progress-bar progress_color" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; min-width: 20px;">100%
                      </div>
                   </div>
                </div>  
             </div>
             <div class="row progressbar_holder">
                <div class="progress_title">
                   <span class="hashtag">#△△</span>
                   <span class="letter">C</span>
                </div>                        

                <div class="progress_size">
                   <div class="progress">
                      <div class="progress-bar progress_color" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:0%; min-width: 20px;">0%
                      </div>
                   </div>
                </div>  
             </div> -->
          </div>
        </div>
    </div>
<!--    <div class="envelope_area">-->
<!--       <div class="envelope">-->
<!--          <a href="#">-->
<!--            <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--          </a>-->
<!--       </div>-->
<!--    </div>-->
  </div>
</div>

@endsection


  