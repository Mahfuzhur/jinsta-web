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

          <div class="tem_sec_holder">
              <div class="tem_sec">
                   <h4 class="tem_text">登録済みリスト</h4>           
              </div>
          </div>

         <div class="row dest_temp_holder">
            <div class="col-sm-4">
            	 <div class="card processing">
                  <div class="card-body">
                    <div class="title-area">
                        <h5 class="card-title">#Hastag_A</h5>
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
            </div>              
    	</div>
	</div>
<div class="envelope_area">
   <div class="envelope">
      <i class="fa fa-envelope" aria-hidden="true"></i>
   </div>
</div>
  <!-- /#page-content-wrapper -->          
</div>
@endsection