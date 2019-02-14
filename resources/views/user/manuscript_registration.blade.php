@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
          <div class="create_btn_holder">
              <a href="{{asset('create-manuscript')}}">
                  <div class="create_new_template">
                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
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
                      <div class="img_holder">
                          <img src="{{asset('uploads/template/'.$template->image)}}" alt="Image" style="width:250px;height: 150px;">
                      </div>
                      <div class="temp_content">
                          <div class="title">
                              <h4>1.{{$template->title}}</h4>
                          </div>
                          <div class="temp_desc">
                              <p>{{$template->description}}
                              <!-- </br> 本日は良い天気ですね。 -->
                            </p>
                          </div>                              
                          <div class="edit_icon">
                              <a href="{{URL::to('edit-template/'.$template->id)}}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                              </a>
                          </div>
                      </div>
                  </div>
                  <?php $i++;?>
                @endforeach
                  </div>                                                         
              </div>
              <!--.row-->

              <!-- pagination  -->
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                {{$all_template->links()}}                         
                  <!-- <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>  -->                        
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