@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
          <div class="create_btn_holder">
              <a href="{{asset('create-manuscript')}}">
                  <div class="create_new_template">
                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                    <span class="new_template">Create New Template</span>
                  </div>
              </a>
          </div>

          <div class="tem_sec_holder">
            @if(count($all_template) > 0)
              <div class="tem_sec">
                   <h4 class="tem_text">Registered Template</h4>
              </div>
            @else
            <div class="tem_sec">
                   <h4 class="tem_text">There is No Manuscript Template Registered.<br>Please Create a New One.</h4>
              </div>
              @endif
          </div>

          @if(session('edit_success'))
          <div class="alert alert-success">
              <p>{{ session('edit_success') }} &#10004; </p>
          </div> 
          @endif
          @if ( Session::has('delete_success') )
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  <span class="sr-only">Close</span>
              </button>
              <strong>{{ Session::get('delete_success') }}  &#10004; </strong>
          </div>
          @endif

          <div class="row temp_holder">
            <div id="temp_carousel" class="col-md-12">                      
              <div class="row">
                <?php $i = 1;?>
                @foreach($all_template as $template)
                <div class="col-sm-4">
                  <div class="single_template">
                      <div class="img_holder">
                        @if($template->image != NULL)
                          <img src="{{asset('uploads/'.$template->image)}}" alt="Image" style="width:250px;height: 150px;">
                        @else
                        <img src="{{asset('assets/img/No_Image_Available.jpg')}}" alt="Image" style="width:250px;height: 150px;">
                        @endif
                      </div>
                      <div class="temp_content">
                          <div class="title">
                              <h4>{{ str_limit($template->title, $limit = 10, $end = '...') }}</h4>
                          </div>
                          <div class="temp_desc">
                              <p>{{ str_limit($template->description, $limit = 30, $end = '...') }}
                              <!-- </br> 本日は良い天気ですね。 -->
                            </p>
                          </div>                              
                          <div class="edit_icon">
                              <a href="{{URL::to('edit-template/'.Crypt::encrypt($template->id))}}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                              </a>
                              <span onclick="return confirm_click();">
                              <a href="{{URL::to('delete-template/'.$template->id)}}" class="confirmation">
                                <i class="fa fa-remove" aria-hidden="true"></i>
                              </a>
                            </span>
                          </div>
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
<!--<div class="envelope_area">-->
<!--   <div class="envelope">-->
<!--      <a href="#">-->
<!--        <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--      </a>-->
<!--   </div>-->
<!--</div>-->
@endsection