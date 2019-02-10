@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-md-8 col-sm-6 create_form_sec">
          <form action="{{URL::to('/save-menuscript-info')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="box_title">
              <!-- <h4>テンプレート名：テストテストテスト</h4> -->
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
                {{ session('add_success') }}
              </div> 
              @endif
              <label for="temp_regi">
                 テンプレート名
              </label>
              <input type="text" class="form-control title" id="text" name="title" maxlength="170" placeholder="テストテストテスト" rows="5" required="">
          </div>
            <div class="m-b-35"> 
                <div class="input_box">
                    <label for="temp_regi">
                       テキスト登録
                    </label>
                    <textarea class="form-control" id="text" name="description" maxlength="170" placeholder="テストですよー" rows="5" required=""></textarea>
            <span class="pull-right label label-default" id="count_message"></span>                 
                </div>
            </div>
            <div class="img_reg_upload m-b-35">
                <h4 class="">画像登録</h4>
                <div class="input_box">
                  <label for="file">                          
                      <strong>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                        </svg>
                      </strong>
                      <span>ファイル名：テストテストテスト</span>                          
                  </label>
                  <input type="file" name="image" id="file" class="inputfile csv_input" data-multiple-caption="{count} files selected" multiple="" onchange="readURL(this);" required="">
                </div>
            </div>
            <div class="form_buttons">
                <div class="btn_cancel p_btn">削除する</div>
                <!-- <div class="btn_done p_btn">登録する</div> -->
                <input type="submit" name="" class="btn_done p_btn" value="登録する">
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
          <button class="btn btn-default btn-lg"><a href="#" class="preview" onclick="getPreview();">Preview</a></button>
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