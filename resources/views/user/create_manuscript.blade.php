@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7 col-sm-6 create_form_sec">
          <form action="{{URL::to('/save-menuscript-info')}}" method="post" enctype="multipart/form-data">
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
                 テンプレート名
              </label>
              <input type="text" class="form-control title" id="text" name="title" maxlength="120" placeholder="原稿名を設定してください。" rows="5">
          </div>
            <div class="m-b-35"> 
                <div class="input_box">
                    <label for="temp_regi">
                       テキスト登録
                    </label>
                    <textarea class="form-control" id="text1" name="description" maxlength="120" placeholder="配信原稿文を記入ください。" rows="5"></textarea>
            <span class="pull-right label label-default" id="count_message"></span>                 
                </div>
            </div>
            <div class="img_reg_upload">
                <div class="input_box">
                    <label for="file">                          
                        <span><i class="fa fa-download" aria-hidden="true"></i></span>
                        <span style="font-size: 13px;">画像登録(推奨画像サイズ：横1200px×縦600px)</span>
                                                
                    </label>
                    <input type="file" name="image" id="file" class="inputfile csv_input" data-multiple-caption="{count} files selected" multiple="" onchange="readURL(this);">
                    <img src="{{asset('assets/img/No_Image_Available.jpg')}}" id="image_show_small" alt="Image" style="width:100px;height: 50px;">
                    <!-- <img id="image_show_small" src="#" alt="your image" /> -->
                    <!-- <span class="image_show_small"></span>  -->

                </div>
                <div class="form_buttons">
                    <!-- <input class="btn_cancel p_btn" type="submit" value="削除する"> -->
                    <input class="btn_done p_btn" type="submit" value="保存する">
                </div>
            </div>
            
        </div>
      </form>
        <div class="col-md-4 col-sm-6 preview_img">
          <div class="temp_result">
            <div class="temp_text">
              <!-- <p id="title"></p> -->
              <pre id="description"></pre>
              <div class="image_show">
                
              </div>            
            </div>
          </div>
          <div class="preview_btn">
          <button class="btn btn-default btn-lg"><a href="#" class="preview" onclick="getPreview();">表示サンプルを確認</a></button>
          </div>
        </div>
      </div>

<!--        <div class="envelope_area">-->
<!--           <div class="envelope">-->
<!--              <a href="#">-->
<!--                <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--              </a>-->
<!--           </div>-->
<!--        </div>-->
    </div>
</div>
@endsection