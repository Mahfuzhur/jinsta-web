@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
          <div class="create_btn_holder">
              <a href="{{URL::to('create-destination')}}">
                  <div class="create_new_template">                            
                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                    <span class="new_template">宛先登録</span>
                  </div>
              </a>
          </div>
<!--          <div class="create_btn_holder">-->
<!--              <a href="{{URL::to('hashtag-manually-add')}}">-->
<!--                  <div class="create_new_template">                            -->
<!--                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>-->
<!--                    <span class="new_template">手動で追加</span>-->
<!--                  </div>-->
<!--              </a>-->
<!--          </div>-->

          <div class="tem_sec_holder">
              <div class="tem_sec">
                  @if(count($all_hashtag) > 0)
                   <h4 class="tem_text">登録済みリスト</h4>
                   @else  
                   <h4 class="tem_text">登録済ずの宛先リスト（ハッシュタグリスト）はありません。<br>新規作成をお願いします。</h4>
                   @endif
                   @if ( Session::has('success') )
                      <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                          <span class="sr-only">Close</span>
                      </button>
                      <strong>{{ Session::get('success') }}  &#10004; </strong>
                  </div>
                  @endif  
                  @if ( Session::has('delete_success') )
                      <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                          <span class="sr-only">Close</span>
                      </button>
                      <strong>{{ Session::get('delete_success') }}  &#10004; </strong>
                  </div>
                  @endif       
              </div>
          </div>

         <div class="row dest_temp_holder">
          @if(isset($all_hashtag))
          @foreach($all_hashtag as $hashtag)
            <div class="col-sm-4">
            	 <div class="card processing">
                  <div class="card-body">
                    <div class="title-area">
                        <h5 class="card-title">{{$hashtag->hashtag}}</h5>
                        <!-- <a class="edit_icon" href="{{URL::to('edit-destination-registration/'.$hashtag->id)}}">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a> --> 
                        <span onclick="return confirm_click();">
                        <a class="edit_icon" href="{{URL::to('delete-destination-registration/'.$hashtag->id)}}">
                           <i class="fa fa-remove" aria-hidden="true"></i>
                        </a>   
                        </span>  
                    </div>
                    <div class="img_holder">
                        <img class="test_img" src="{{asset('assets/img/user.png')}}">
                    </div>
                    
                    <div class="card-text">
                      <p>送信対象者数</p>
                      <h4>{{$hashtag->total_user}}人</h4>
                      <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus nisi tincidunt.</p> -->
                    </div>              
                    <form action="{{URL::to('compare-hashtag')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="hashtag" value="{{$hashtag->id}}">
                        <button class="btn btn-success btn-md btn-responsive" style="margin-left: 35%" type="submit" >送信設定</button>
                    </form>
                  </div>
                </div>
            </div>
            @endforeach
            @endif
            <!-- <div class="col-sm-4">
              	<div class="card processing">
  						  <div class="card-body">
  						    <div class="title-area">
                      <h5 class="card-title">#Hastag_B</h5>
                      <a class="edit_icon" href="#">
                         <i class="fa fa-pencil" aria-hidden="true"></i>
                      </a>      
                  </div>
                  <div class="img_holder">
                      <img class="test_img" src="{{asset('assets/img/user.png')}}">
                  </div>
                  <div class="card-text">
                    <h4>108,982</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus nisi tincidunt.</p>
                  </div>					    
  						    
  						  </div>
				          </div>
            </div>
            <div class="col-sm-4">
  						<div class="card processing">
                <div class="card-body">
                    <div class="title-area">
                        <h5 class="card-title">#Hastag_C</h5>
                        <a class="edit_icon" href="#">
                           <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>      
                    </div>
                    <div class="img_holder">
                          <img class="test_img" src="{{asset('assets/img/user.png')}}">
                    </div>
                    <div class="card-text">
                        <h4>108,982</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus nisi tincidunt.</p>
                    </div>             
                          
  						  </div>
  						</div>
            </div> -->              
    	</div>
	</div>
<!--<div class="envelope_area">-->
<!--   <div class="envelope">-->
<!--      <a href="#">-->
<!--        <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--      </a>-->
<!--   </div>-->
<!--</div>-->
  <!-- /#page-content-wrapper -->          
</div>
@endsection