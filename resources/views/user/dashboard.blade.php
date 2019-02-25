@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">        

  <div class="container-fluid">
    <div class="row row-eq-height">
      <div class="col-md-6 col-sm-12">
          <div class="test_section">

             <center><img class="test_img" src="{{$json_selfinfo['user']['profile_pic_url']}}"></center>
              <div class="test"><center>{{$json_selfinfo['user']['username']}}</center></div>

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
                <h3 class="pro_info"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>フォントサイズ統一してください。</h3><br>
                  <div class="row progress_vertical_holder">
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
                 </div> 
                 <div class="dash_footer">
                    <span class="total"><b>{{$last_day}} last day </br> 送信数</b></span> <br>
                    <span class="total"><b>1,000 </br> 既読数 </b></span> <br>
                    <span class="total"><b> 1% </br> 既読率</b></span>
                </div>
            </div>
            <div class="tab-pane" id="2a">
                <h3 class="pro_info"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>ダッシュボード</h3><br>
                <div class="row progress_vertical_holder">
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
                 </div>                   
                 <div class="dash_footer">
                    <span class="total"><b>{{$last_week}} last week </br> 送信数</b></span> <br>
                    <span class="total"><b>1,000 </br> 既読数 </b></span> <br>
                    <span class="total"><b> 1% </br> 既読率 </b></span>
                </div>                      
          </div>
          <div class="tab-pane active" id="3a">
                <h3 class="pro_info"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>ダッシュボード</h3><br>
                <div class="row progress_vertical_holder">
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
                 </div>                     
                 <div class="dash_footer">
                    <span class="total"><b>送信数 <br> {{$last_month}} last month</b></span> <br>
                    <span class="total"><b>既読数 <br> 1,000</b></span> <br>
                    <span class="total"><b>既読率 <br> 1%</b></span>
                </div>                      
            </div>
          </div>
        </div>
        <div class="progress_view m-t-30">

           <h4 class="progress_margin"><span><img src="{{asset('assets/img/iconsshade333.png')}}" alt=""></span> 進行ステータス</h4>
           @if(isset($data_info))
           @foreach($data_info as $data )                     

              <div class="row progressbar_holder">
                <div class="progress_title">
                   <span class="hashtag">#{{$data->hashtag}}</span>
                   <span class="letter">{{$data->title}}</span>
                </div>                        

                <div class="progress_size">
                   <div class="progress">
                      <div class="progress-bar progress_color" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:80%; min-width: 20px;">{{$data->total_sent}}
                      </div>
                   </div>
                </div>  
             </div>
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


  