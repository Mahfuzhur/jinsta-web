@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">        

    <div class="container-fluid">
      <div class="row row-eq-height">
        <div class="col-md-4 col-sm-12 p_r_0">
            <div class="test_section">
               <div class="test"><center>@test test</center></div>
               <center><img class="test_img" src="{{asset('assets/img/user.png')}}"></center>

               <div class="row inst_section">
                  <div class="inst_title first">
                     <h4 class="instagram">Instagram</h4>
                  </div>
                  <div class="inst_title second">
                     <h4><i class="fa fa-check-circle-o"></i> どうして </h4>
                  </div>
               </div>

               <div class="jp_language">
                  <span>どうして</span>
               </div>
               <div class="clasa">
                  <span>Aプランの配信が終了しました。</span>
                </div>                       
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
          <div id="exTab1" class="m-t-25">
            <ul class="nav nav-pills">
                <li>
                    <a href="#1a" data-toggle="tab">日</a>
                </li>
                <li>
                    <a href="#2a" data-toggle="tab">週</a>
                </li>
                <li class="active">
                    <a href="#3a" data-toggle="tab">月</a>
                </li>                    
            </ul>
            <div class="tab-content">                    
              <div class="tab-pane" id="1a">
                  <h3 class="pro_info">ダッシュボード</h3><br>                      
                   <div class="dash_footer">
                      <span class="total"><b>送信数 : 100,000</b></span> <br>
                      <span class="total"><b>既読数 : 1,000</b></span> <br> 
                      <span class="total"><b>既読率 : 1% </b></span>
                  </div>                      
              </div>
              <div class="tab-pane" id="2a">
                  <h3 class="pro_info">ダッシュボード</h3><br>                      
                   <div class="dash_footer">
                      <span class="total"><b>送信数 : 100,000</b></span> <br>
                      <span class="total"><b>既読数 : 1,000</b></span> <br> 
                      <span class="total"><b>既読率 : 1% </b></span>
                  </div>                      
            </div>
            <div class="tab-pane active" id="3a">
                  <h3 class="pro_info">ダッシュボード</h3><br>                      
                   <div class="dash_footer">
                      <span class="total"><b>送信数：100,000</b></span> <br>
                      <span class="total"><b>既読数 : 1,000</b></span> <br> 
                      <span class="total"><b>既読率 : 1% </b></span>
                  </div>                      
              </div>
            </div>
          </div>
          <div class="progress_view m-t-5">
             <h4 class="progress_margin">進行ステータス</h4>
             
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
                        <div class="progress-bar progress_color1" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; min-width: 20px;">100%
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
                        <div class="progress-bar progress_color2" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:0%; min-width: 20px;">0%
                        </div>
                     </div>
                  </div>  
               </div>
            </div>
          </div>
      </div>
      <div class="envelope_area">
         <div class="envelope">
            <i class="fa fa-envelope" aria-hidden="true"></i>
         </div>
      </div>
    </div>
</div>
@endsection


  