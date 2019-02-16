@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div id="exTab1">
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
                <!-- <div class="tab-content">                    
                  <div class="tab-pane" id="1a">                    
                       <div class="dash_footer">
                          <span class="total"><b></b></span> <br>
                          <span class="total"><b></b></span> <br> 
                          <span class="total"><b></b></span>
                        </div>                      
                    </div>
                    <div class="tab-pane" id="2a">                      
                       <div class="dash_footer">
                          <span class="total"><b></b></span> <br>
                          <span class="total"><b></b></span> <br> 
                          <span class="total"><b></b></span>
                        </div>                      
                  </div>
                  <div class="tab-pane active" id="3a">                    
                       <div class="dash_footer">
                          <span class="total"><b></b></span> <br>
                          <span class="total"><b></b></span> <br> 
                          <span class="total"><b></b></span>
                      </div>                      
                    </div>
                </div> -->
              </div>

              <div class="progress_view">
                <h4 class="progress_margin"> <span><img src="img/iconshade222.png" alt=""></span> 進行ステータス</h4>      
                  <div class="row progressbar_holder">
                      <div class="progress_title">
                         <span class="hashtag">#□□</span>
                         <span class="letter">B</span>
                      </div>                        

                      <div class="progress_size">
                         <div class="progress">
                            <div class="progress-bar progress_color" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:80%; min-width: 20px;">80%
                            </div>
                         </div>
                      </div>  
                   </div>
                   <div class="row progressbar_holder">
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
                </div>
            </div>                    
            </div>
            <!-- <div class="col-md-5">
              <div id="exTab1">
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
                          <span class="total"><b></b></span> <br>
                          <span class="total"><b></b></span> <br> 
                          <span class="total"><b></b></span>
                        </div>                      
                    </div>
                    <div class="tab-pane" id="2a">                      
                       <div class="dash_footer">
                          <span class="total"><b></b></span> <br>
                          <span class="total"><b></b></span> <br> 
                          <span class="total"><b></b></span>
                        </div>                      
                  </div>
                  <div class="tab-pane active" id="3a">                    
                       <div class="dash_footer">
                          <span class="total"><b></b></span> <br>
                          <span class="total"><b></b></span> <br> 
                          <span class="total"><b></b></span>
                      </div>                      
                    </div>
                </div>
              </div>
            </div> -->
        </div>
        <div class="row box_holder">
          <div class="rect_box">
            <h4>リスト数 <br> {{$numberOfLists}}</h4>
          </div>
          <div class="rect_box">
            <h4>送信数 <br> {{$numberSent}}</h4>
          </div>
          <div class="rect_box">
            <h4>開封率</h4>
          </div>
          <div class="rect_box">
            <h4>アクション回数</h4>
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
@endsection