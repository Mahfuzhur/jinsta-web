@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="ajax_hashtag_list">
	<div class="container-fluid">
	  <div class="row create_destination">            
	    <div class="col-sm-12 main_content">
	        <!-- <div class="box_title">
	            <h4>宛先名は削除でお願いします。</h4>
	        </div> -->
	        <!-- <form action="{{URL::to('hashtag-list-search')}}" method="post"> -->
	        <form action="javascript:void(0);" method="post">
	        {{csrf_field()}}
	        <div id="Load" class="load" style="display: none;">
		      <div class="load__container">
		        <div class="load__animation"></div>
		        <div class="load__mask"></div>
		        <span class="load__title">リクエスト中です。ブラウザを閉じないでください。</span>
		      </div>
		    </div>
			<meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
	        <h4>#から作成</h4>
	        <h5 id="exception_msg" style="color: red;"></h5>
	        <div class="hashtag_title left-border m-b-40">
	        	@if(session('errot_message'))
	        	<div class="alert alert-danger">
	        		{{session('errot_message')}}
	        	</div>
	        	@endif

	        	@if(session('message'))
	        	<div class="alert alert-success">
                    <p>{{ session('message') }} &#10004; </p>
	        	</div>
	        	@endif



	        	@if(session('instagram_error_msg'))
	        	<div class="alert alert-danger">
	        		{{session('instagram_error_msg')}}
	        	</div>
	        	@endif

	        	@if ( Session::has('hashtag_found_msg') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('hashtag_found_msg') }}</strong>
                    </div>
                    @endif
	        	
                    <!-- <div class="alert alert-danger alert-dismissible hashtag_search_alert" role="alert" style="display: none;">
                        
                    </div> -->
                    
	            
	            <div class="input_box">                    
	                <div class="input-group"> 
	                	                           
	                    @if(isset($hashtag))                           
	                    <input type="text" name="hashtag" id="hashtag" value="{{$hashtag}}" class="hashtag_input" required="">
	                    @elseif(Session::get('hashtag_found_msg'))
	                    <input type="text" name="hashtag" id="hashtag"  value="{{old('hashtag')}}" class="hashtag_input" required="">
	                    @else
	                    <input type="text" name="hashtag" id="hashtag"  placeholder="#なしでキーワードだけ入力してください" class="hashtag_input" required="">
	                    @endif
	                    


	                    <div class="input-group-append" style="margin-left: -10px;">
	                    	<button type="button" name="" id="but_search" class="btn btn-info" style="background: #06af94;">Search</button>
	                      <!-- <span class="input-group-text" id="">Search</span> -->
	                    </div>
	                </div>                   
	            </div>
	        </div>
			</form>

			<div class="ajax_hashtag_list"></div>
			<!-- <div class='response'></div> -->
			<form action="{{URL::to('hashtag-list-search-csv')}}" method="post">


			    {{csrf_field()}}
			    <div class="radio_list_area">
			    	@if(isset($results))
			        <div class="radio_label">
			            <h3>Select List</h3>
			        </div>
			        <div class="radio_list">
			            <div class="single_radio radio1">
			        	<?php $i=0;?>
							@foreach($results as $result)
							@if($i < 9)
			              <label class="checkcontainer"> {{$result->name}}-> {{$result->search_result_subtitle}}
			                <input type="radio" name="hashtag_list" value="{{$result->name}}" required=""><br>
			                <span class="radiobtn"></span>
			              </label>
			            @endif
			            <?php $i++;?>
			            @endforeach

			            </div>

			        </div>
			    </div>
			    
			    <div class="form_buttons">
			        <!-- <button class="btn_cancel p_btn">削除する</button> -->
			        <button type="sybmit" class="btn_done p_btn">登録</button>
			    </div>
			    @endif



			</form>
	    </div>


<!--	    <div class="envelope_area">-->
<!--		   <div class="envelope">-->
<!--		      <a href="#">-->
<!--		        <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--		      </a>-->
<!--		   </div>-->
<!--		</div>-->

	</div>


</div>


@endsection