@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

              <div class="progress_view">
                <h4 class="progress_margin"> <span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Change Information</h4>   
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session('delete_success'))
                <div class="alert alert-success">
                    <p>{{ session('delete_success') }} &#10004; </p>
                </div> 
                @endif 
                <div class="col-md-6">
                  <form action="{{URL::to('update-company-info/'.$single_company_info->id)}}" method="post">
                    {{csrf_field()}}
                      <div style="margin-left: 6%">
                          <label>Company Name</label>
                          <input type="text" name="company_name" class="form-control" value="{{$single_company_info->company_name}}" placeholder="Enter company name" required="">
                          <label>Name</label>
                          <input type="text" name="name" class="form-control" value="{{$single_company_info->name}}" placeholder="Enter name" required="">
                          <label>Email</label>
                          <input type="email" name="email" class="form-control" value="{{$single_company_info->email}}" placeholder="Enter email" required="">
                          <label>Mobile</label>
                          <input type="text" name="mobile" class="form-control" value="{{$single_company_info->mobile}}" placeholder="Enter mobile" required="">
                          <br>
                          <button type="submit" class="btn btn-success btn-md">Save Changes</button>
                      </div>

                  </form>
                </div>
              </div>                    
            </div>
            
        </div>
        
<!--        <div class="envelope_area">-->
<!--           <div class="envelope">-->
<!--              <a href="#">-->
<!--                <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--              </a>-->
<!--           </div>-->
<!--        </div>           -->
  </div>
@endsection