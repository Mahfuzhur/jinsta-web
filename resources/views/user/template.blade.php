@extend('master')
@section('user_main_content')

   <div class="col-md-10 col-sm-12 col-xs-12 box_bottom">

    <div class="row">
      <div class="col-md-4">
       <a class="text_dec" href="#"><div class="create_new_template">
            <img src="{{asset('assets/img/plus1.png')}}"> <span class="new_template">Create New Template</span>
          </div>
        </a>
      </div>
      <div class="col-md-8">
      </div>
    </div>

  <div class="tem_sec">
    <div class="row">
      <div class="col-md-2">
         <span class="tem_text">Templates</span>
      </div>
      <div class="col-md-8">
        <hr class="tem_sec_hr">
      </div>
    </div>
  </div>  

  
    <div class="row">
      <div class="col-md-3 title">
        <h4 class="box_title">1.Title</h4>
        <span class="title_icon"><i class="fa fa-edit"></i></span><br>
        <h5 class="template_des">Template description</h5><br>
        <img class="cloud_img" src="{{asset('assets/img/cloud.png')}}">
      </div>

      <div class="col-md-3 hello">
        <h4 class="box_title">2.Hello</h4>
        <span class="title_icon"><i class="fa fa-edit"></i></span><br>
        <h5 class="template_des">Hello<br>Are you doing well</h5><br>
        <img class="freinship_img" src="{{asset('assets/img/freindship.png')}}">
      </div>

      <div class="col-md-3 Good">
        <h4 class="box_title">3.Good Evening</h4>
        <span class="title_icon"><i class="fa fa-edit"></i></span><br>
        <h5 class="template_des">Good Evening <br>Let's go to cooking soon </h5><br>
        <img class="cook_img" src="{{asset('assets/img/cook.png')}}">
      </div>

    </div>
    
   </div>

   <div class="row envelope_area1">
       <div class="col-md-2 col-sm-12 col-xs-12">
          <a href="#"><span style="color: #d9534f!important;"><span class="glyphicon glyphicon-envelope envelope_size"></span></span></a>
       </div>
  </div>

@endsection