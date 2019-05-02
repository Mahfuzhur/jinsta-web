@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
	<div class="container-fluid">
	  <div class="row create_destination">            
	    <div class="col-sm-12 main_content">
	        <!-- <div class="box_title">
	            <h4>宛先名は削除でお願いします。</h4>
	        </div> -->
	        <form action="{{URL::to('hashtag-list-search')}}" method="post">
	        {{csrf_field()}}
	        <div id='loader' style='display: none;'>
			  <img src="{{asset('assets/img/progressbar2.gif')}}">
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
	                    	<button type="submit" name="" id="but_search" class="btn btn-info" style="background: #06af94;">Search</button>
	                      <!-- <span class="input-group-text" id="">Search</span> -->
	                    </div>
	                </div>                   
	            </div>
	        </div>
			</form>
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
						   
			              <!-- <label class="checkcontainer">
			                <input type="radio" name="list" value=""><br>
			                <span class="radiobtn"></span>
			              </label>
			              <label class="checkcontainer">
			                <input type="radio" name="list" value="">
			                <span class="radiobtn"></span>
			              </label> -->
			            </div>
			            <!-- <div class="single_radio radio2">
			              <label class="checkcontainer">
			                <input type="radio" name="list" value=""><br>
			                <span class="radiobtn"></span>
			              </label>
			              <label class="checkcontainer">
			                <input type="radio" name="list" value=""><br>
			                <span class="radiobtn"></span>
			              </label>
			              <label class="checkcontainer">
			                <input type="radio" name="list" value="">
			                <span class="radiobtn"></span>
			              </label>
			            </div>
			            <div class="single_radio radio3">
			              <label class="checkcontainer">
			                <input type="radio" name="list" value=""><br>
			                <span class="radiobtn"></span>
			              </label>
			              <label class="checkcontainer">
			                <input type="radio" name="list" value=""><br>
			                <span class="radiobtn"></span>
			              </label>
			              <label class="checkcontainer">
			                <input type="radio" name="list" value="">
			                <span class="radiobtn"></span>
			              </label>
			            </div> -->
			        </div>
			    </div>
			    
			    <!-- <div class="csv_upload left-border m-b-40">
			        <h4 class="">ファイルアップロード</h4>
			        <div class="input_box">
			          <label for="file">
			              <span><i class="fa fa-upload"></i></span> 
			          </label>
			          <input type="file" name="file[]" id="file" class="inputfile csv_input" data-multiple-caption="{count} files selected" multiple="">                      
			        </div>
			    </div>

			    <div class="id_title left-border m-b-40">
			        <h4>個別入力</h4>
			        <div class="input_box">                    
			            <div class="input-group">
			                <div class="input-group-prepend">
			                  <span class="input-group-text" id=""><i class="fa fa-pencil"></i></span>
			                </div>
			                <input type="text" name="id" id="id" class="id_input">                   
			            </div>                   
			        </div>
			    </div> -->
			   
			    
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