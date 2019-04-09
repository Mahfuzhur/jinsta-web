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