@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
  <div class="container-fluid">
    <div class="row create_destination">
    <form action="{{URL::to('save-destination-registration/'.$single_hashtag->id)}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}            
      <div class="col-sm-12 main_content">
          <div class="box_title">
              <h4>宛先リスト名：テストテストテスト</h4>
          </div>
            

          <div class="id_title left-border m-b-40">
              <h4>個別入力</h4>
              <div class="input_box">                    
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id=""><i class="fa fa-pencil"></i></span>
                      </div>
                      <input type="text" name="id" id="id" class="id_input" required="">                   
                  </div>                   
              </div>
          </div>
         

          <div class="form_buttons">
              <button class="btn_cancel p_btn">削除する</button>
              <button type="submit" class="btn_done p_btn">登録する</button>
          </div>
      </div>
      </form>
      
      
<!--      <div class="envelope_area">-->
<!--         <div class="envelope">-->
<!--            <a href="#">-->
<!--              <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--            </a>-->
<!--         </div>-->
<!--      </div> -->
  </div>
</div>
@endsection