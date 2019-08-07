@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7 col-sm-6 create_form_sec">
          <form action="{{URL::to('/update-template/'.$single_template->id)}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="box_title">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
              @endif
              @if(session('add_success'))
              <div class="alert alert-success">
                  <p>{{ session('add_success') }} &#10004; </p>
              </div> 
              @endif
              @if(session('empty_msg'))
              <div class="alert alert-success">
                  <p>{{ session('empty_msg') }} &#10004; </p>
              </div> 
              @endif
              <!-- <h4>テンプレート名：テストテストテスト</h4> -->
              <label for="temp_regi">
                  Template Name
              </label>
              <input type="text" class="form-control title" id="text" name="title" value="{{$single_template->title}}" maxlength="170" placeholder="Test test test" rows="5">
          </div>
            <div class="m-b-35"> 
                <div class="input_box">
                    <label for="temp_regi">
                        Text Registration
                    </label>
                    <textarea class="form-control" id="text" name="description" maxlength="170" placeholder="It is a Test" rows="5">{{$single_template->description}}</textarea>
            <span class="pull-right label label-default" id="count_message"></span>                 
                </div>
            </div>
            <div class="img_reg_upload">
                <div class="input_box">
                    <label for="file">                          
                        <span><i class="fa fa-download" aria-hidden="true"></i></span>
                        <span>Image Registration</span>
                    </label>
                    <input type="file" name="image" id="file" class="inputfile csv_input" data-multiple-caption="{count} files selected" multiple="" onchange="readimageURL(this);">
                    <input type="hidden" name="exits_image" value="{{$single_template->image}}">
                    
                  <!-- <img src="{{asset('uploads/'.$single_template->image)}}" class="img-responsive" style="width: 100px;height: 50px;"> -->
                  
                  <img src="{{asset('assets/img/No_Image_Available.jpg')}}" id="no_image_id" alt="Image" style="width:100px;height: 50px;">
                  <!-- <span class="edit_image_show_small"></span> -->
                  
                </div>
                <div class="form_buttons">
                    <!-- <input class="btn_cancel p_btn" type="submit" value="削除する"> -->
                    <input class="btn_done p_btn" type="submit" value="Save">
                </div>
            </div>
            
        </div>
      </form>
        <div class="col-md-4 col-sm-6">
          <div class="temp_result">
            <div class="temp_text">
              <p id="title"></p>
              <p id="description"></p>
              <div class="image_show">
                
              </div>            
            </div>
          </div>
          <div class="preview_btn">
          <button class="btn btn-default btn-lg"><a href="#" class="preview" onclick="getPreview();">Confirm Display Sample</a></button>
          </div>
        </div>
      </div>

<!--        <div class="envelope_area">-->
<!--           <div class="envelope">-->
<!--              <i class="fa fa-envelope" aria-hidden="true"></i>-->
<!--           </div>-->
<!--        </div>-->
    </div>
</div>
@endsection