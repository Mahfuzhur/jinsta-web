@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div id="exTab1">
<!--                <ul class="nav nav-pills">-->
<!--                    <li>-->
<!--                        <a href="#1a" data-toggle="tab">日</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#2a" data-toggle="tab">週</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a class="show active" href="#3a" data-toggle="tab">月</a>-->
<!--                    </li>                    -->
<!--                </ul>-->
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
                <h4 class="progress_margin"> <span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span> Progress Status</h4>
                  @if(isset($data_info))
                   @foreach($data_info['dm_sent'] as $data )
                    @foreach($data_info['without_dm_sent'] as $without_data )                     
                    @if($data->hashtag_name == $without_data->hashtag_id)
                      <div class="row progressbar_holder">
                        <div class="progress_title">
                           <span class="hashtag">#{{str_limit($data->hashtag, $limit = 12, $end = '..')}}</span>
                           <span class="letter">{{str_limit($data->title, $limit = 12, $end = '..')}}</span>
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
            <div class="row temp_holder">
            <div id="temp_carousel" class="col-md-12">                      
              <div class="row">
                <?php $i = 1;?>
                @foreach($data_info['template_sent'] as $template)
                <div class="col-sm-4">
                  <div class="single_template">
                      <div class="img_holder">
                        <span class="badge"><span>DM</span><br>{{$template->total_sent}}</span>
                        @if($template->image != NULL)
                          <img src="{{asset('uploads/'.$template->image)}}" alt="Image" style="width:250px;height: 150px;">
                        @else
                        <img src="{{asset('assets/img/No_Image_Available.jpg')}}" alt="Image" style="width:250px;height: 150px;">
                        @endif
                      </div>
                      <div class="temp_content">
                          <div class="title">
                              <h4>{{ str_limit($template->title, $limit = 15, $end = '...') }}</h4>
                          </div>
                          <div class="temp_desc">
                              <p>{{ str_limit($template->description, $limit = 30, $end = '...') }}
                              <!-- </br> 本日は良い天気ですね。 -->
                            </p>
                          </div>                              
                          <!-- <div class="edit_icon">
                              <a href="{{URL::to('edit-template/'.Crypt::encrypt($template->id))}}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                              </a>
                              <span onclick="return confirm_click();">
                              <a href="{{URL::to('delete-template/'.$template->id)}}" class="confirmation">
                                <i class="fa fa-remove" aria-hidden="true"></i>
                              </a>
                            </span>
                          </div> -->
                      </div>
                  </div>
                </div>
                  <?php $i++;?>
                @endforeach
                  </div>                                                         
              </div>
              <!--.row-->

              <!-- pagination  -->
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                {{$data_info['template_sent']->links()}}                         
                  <!-- <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>  -->                        
                </ul>
              </nav>                   
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
            <h4>Number of Lists <br> {{$numberOfLists}}</h4>
          </div>
          <div class="rect_box">
            <h4>Number of Transmissions <br> {{$numberSent}}</h4>
          </div>
          <!-- <div class="rect_box">
            <h4>開封率</h4>
          </div> -->
          <div class="rect_box">
            <h4>Number of Actions <br>{{$numberOfSchedule}}</h4>
          </div>
        </div>
<!--        <div class="envelope_area">-->
<!--           <div class="envelope">-->
<!--              <a href="#">-->
<!--                <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--              </a>-->
<!--           </div>-->
<!--        </div>           -->
  </div>
  
  <style type="text/css">
  .badge{
    position: absolute;
    top: -10px;
    left: 20px;
    padding: 25px 25px;
    border-radius: 50%;
    background: #ffffff;
    color: black;
    border: 1px solid #06af94;
</style>
@endsection