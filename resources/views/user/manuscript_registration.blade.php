@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
          <div class="create_btn_holder">
              <a href="{{asset('create-manuscript')}}">
                  <div class="create_new_template">
                    <img src="{{asset('assets/img/plus.png')}}">
                    <span class="new_template">テンプレート新規作成</span>
                  </div>
              </a>
          </div>

          <div class="tem_sec_holder">
              <div class="tem_sec">
                   <h4 class="tem_text">登録済みテンプレート</h4>     
              </div>
          </div>

          @if(session('edit_success'))
          <div class="alert alert-success">
            {{ session('edit_success') }}
          </div> 
          @endif

          <div class="row temp_holder">
            <div id="temp_carousel" class="col-md-12">                      
              <div class="row">
                <?php $i = 1;?>
                @foreach($all_template as $template)
                  <div class="single_template">
                      <div class="title">
                          <h4>{{$i}}. {{$template->title}} </h4>
                      </div>
                      <div class="temp_desc">
                          <p>{{$template->description}}<!-- </br> 本日は良い天気ですね。 -->
                          </p>
                      </div>
                      <div class="img_holder">
                          <img src="{{asset('uploads/template/'.$template->image)}}" alt="Image" style="width:250px;height: 150px;">
                      </div>
                      <div class="edit_icon">
                          <a href="{{URL::to('edit-template/'.$template->id)}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          </a>
                      </div>
                  </div>
                <?php $i++;?>
                @endforeach
                  <!-- <div class="single_template">
                      <div class="title">
                          <h4>2. こんにちは</h4>
                      </div>
                      <div class="temp_desc">
                          <p>こんにちは </br> 元気にしてました？</p>
                      </div>
                      <div class="img_holder">
                          <img src="http://placehold.it/250x100" alt="Image" style="max-width:100%;">
                      </div>
                      <div class="edit_icon">
                          <a href="#">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          </a>
                      </div>
                  </div>
                  <div class=" single_template">
                      <div class="title">
                          <h4>3. こんばんは </h4>
                      </div>
                      <div class="temp_desc">
                          <p>こんばんは </br> そろそろご飯に行こう！</p>
                      </div>
                      <div class="img_holder">
                          <img src="http://placehold.it/250x100" alt="Image" style="max-width:100%;">
                          <div class="edit_icon">
                              <a href="#">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a>
                          </div>
                      </div>
                  </div>
                <div class="single_template">
                      <div class="title">
                          <h4>4. おはよう </h4>
                      </div>
                      <div class="temp_desc">
                          <p>おはようございます。</br> 本日は良い天気ですね。</p>
                      </div>
                      <div class="img_holder">
                          <img src="http://placehold.it/250x100" alt="Image" style="max-width:100%;">
                      </div>
                      <div class="edit_icon">
                          <a href="#">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          </a>
                      </div>
                  </div>
                  <div class="single_template">
                      <div class="title">
                          <h4>5. こんにちは</h4>
                      </div>
                      <div class="temp_desc">
                          <p>こんにちは </br> 元気にしてました？</p>
                      </div>
                      <div class="img_holder">
                          <img src="http://placehold.it/250x100" alt="Image" style="max-width:100%;">
                      </div>
                      <div class="edit_icon">
                          <a href="#">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                          </a>
                      </div>
                  </div>
                  <div class=" single_template">
                      <div class="title">
                          <h4>6. こんばんは </h4>
                      </div>
                      <div class="temp_desc">
                          <p>こんばんは </br> そろそろご飯に行こう！</p>
                      </div>
                      <div class="img_holder">
                          <img src="http://placehold.it/250x100" alt="Image" style="max-width:100%;">
                          <div class="edit_icon">
                              <a href="#">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </a>
                          </div>
                      </div>
                  </div> -->                                                           
              </div>
              <!--.row-->

              <!-- pagination  -->
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center"> 
                {{$all_template->links()}}                               
                  <!-- <li class="page-item active"><a class="page-link" href="#">1</a></li>              
                  <li class="page-item"><a class="page-link" href="#">2</a></li> -->                         
                </ul>
              </nav>                   
        </div>               
    </div>

</div>
<div class="envelope_area">
   <div class="envelope">
      <i class="fa fa-envelope" aria-hidden="true"></i>
   </div>
</div>
@endsection