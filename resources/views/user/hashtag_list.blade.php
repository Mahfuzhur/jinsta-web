@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
	<div class="container-fluid">
	  <div class="row create_destination">            
	    <div class="col-sm-12 main_content">
	        <!-- <div class="box_title">
	            <h4>宛先名は削除でお願いします。</h4>
	        </div> -->
	        <!-- <form action="{{URL::to('hashtag-list-search')}}" method="post">
	        {{csrf_field()}} -->
	        <div id='loader' style='display: none;'>
			  <img src="{{asset('assets/img/reload.gif')}}" width='32px' height='32px'>
			</div>
			<meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
	        <h4>#から作成</h4>
	        <div class="hashtag_title left-border m-b-40">
	        	@if(session('errot_message'))
	        	<div class="alert alert-danger">
	        		{{session('errot_message')}}
	        	</div>
	        	@endif

	        	@if(session('message'))
	        	<div class="alert alert-success">
	        		{{session('message')}}
	        	</div>
	        	@endif
	        	
                    <div class="alert alert-danger alert-dismissible hashtag_search_alert" role="alert" style="display: none;">
                        
                    </div>
                    
	            
	            <div class="input_box">                    
	                <div class="input-group"> 
	                	                           
	                    @if(isset($hashtag))                           
	                    <input type="text" name="hashtag" id="hashtag" value="{{$hashtag}}" class="hashtag_input">
	                    @elseif(Session::get('hashtag_found_msg'))
	                    <input type="text" name="hashtag" id="hashtag"  value="{{old('hashtag')}}" class="hashtag_input">
	                    @else
	                    <input type="text" name="hashtag" id="hashtag"  placeholder="#なしでキーワードだけ入力してください" class="hashtag_input">
	                    @endif
	                    
	                    <div class="input-group-append" style="margin-left: -10px;">
	                    	<button type="button" name="" id="but_search" class="btn btn-info" style="background: #06af94;">Search</button>
	                      <!-- <span class="input-group-text" id="">Search</span> -->
	                    </div>
	                </div>                   
	            </div>
	        </div>
			<!-- </form> -->
			<div class='response'></div>
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