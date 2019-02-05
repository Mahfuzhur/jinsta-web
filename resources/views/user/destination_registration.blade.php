@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
          <div class="create_btn_holder">
              <a href="{{URL::to('create-destination')}}">
                  <div class="create_new_template">
                    <img src="{{asset('assets/img/plus.png')}}">
                    <span class="new_template">宛先登録</span>
                  </div>
              </a>

              <!-- <a href="{{URL::to('download-csv')}}">
                  <div class="create_new_template" style="padding: 15px; margin-left: 10px;">
                    <span class="new_template">Download CSV</span>
                  </div>
              </a> -->
          </div>

          <div class="tem_sec_holder">
              <div class="tem_sec">
                   <h4 class="tem_text">登録済みリスト</h4>           
              </div>
          </div>

         <div class="row dest_temp_holder">
            <div class="col-sm-4">
            	<div class="card deliverd">
				  <div class="card-body">
				    <h5 class="card-title">#●●●</h5>
				    <p class="card-text"><i class="fa fa-user"></i>6,790</p>
				    <a class="edit_icon" href="#">
				    	 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				    </a>
				    <div class="notfy_text">
				    	<span>配信済</span>
				    </div>
				  </div>
				</div>
            </div>
            <div class="col-sm-4">
              	<div class="card processing">
				  <div class="card-body">
				    <h5 class="card-title">#▪️▪️▪️</h5>
				    <p class="card-text"><i class="fa fa-user"></i>108,982</p>
				    <a class="edit_icon" href="#">
				    	 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				    </a>
				    <div class="notfy_text">
				    	<span>進行中</span>
				    </div>
				  </div>
				</div>
            </div>
            <div class="col-sm-4">
              	<div class="card faild">
				  <div class="card-body">
				    <h5 class="card-title">#△ △ △</h5>
				    <p class="card-text"><i class="fa fa-user"></i>3,381</p>
				    <a class="edit_icon" href="#">
				    	 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				    </a>
				    <div class="notfy_text">
				    	<span>未使用</span>
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
@endsection