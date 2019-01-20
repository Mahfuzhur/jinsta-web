@extend('master)
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
      	<div class="row">
          	<div class="col-md-12 request">
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