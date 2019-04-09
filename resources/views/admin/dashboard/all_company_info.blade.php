@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

              <div class="progress_view">
                <h4 class="progress_margin"> <span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>スケジュール一覧</h4>   
                @if(session('delete_success'))
                <div class="alert alert-success">
                  {{ session('delete_success') }}
                </div> 
                @endif   
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(isset($_GET['page'])){
                          $i = ($_GET['page']*10)-9;
                        }else{
                          $i = 1;
                        }
                        
                      ?>
                      @if(isset($all_company))
                        @foreach($all_company as $company)
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$company->name}}</td>
                          <td>{{$company->company_name}}</td>
                          <td>{{$company->email}}</td>
                          <td>{{$company->mobile}}</td>
                          <td>Active</td>
                          <td>
                            <!-- <div class="btn-group">
                              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                                <a class="dropdown-item" href="#">Suspend</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                              </div>
                            </div> -->

                            <select class="btn btn-success btn-md">
                              <option>Manage</option>
                              <option><a href="#">Edit</a></option>
                              <option><a href="#">Delete</a></option>
                              <option><a href="#">Suspend</a></option>
                              <option><a href="#">Extra</a></option>
                            </select>
                            
                          </td>
                        </tr>
                        <?php
                          $i++;
                        ?>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
              </div>                    
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                {{$all_company->links()}}                         
                </ul>
              </nav> 
        </div>
        
        <div class="envelope_area">
           <div class="envelope">
              <a href="#">
                <img src="{{asset('assets/img/message64.png')}}" alt="">
              </a>
           </div>
        </div>           
  </div>
@endsection