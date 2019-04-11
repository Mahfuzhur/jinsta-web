@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

              <div class="progress_view">
                <h4 class="progress_margin"> <span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>All Trial List</h4> 
                <div style="margin-bottom: 15px;margin-left: 10px;">
                  <input type="checkbox" name="email"> <span style="font-weight: bold;">Select All</span>
                </div>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Mark</th>
                        <th scope="col">Name</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Trail Duration</th>
                        <th scope="col">Expire Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($all_company_trial_list))
                        @foreach($all_company_trial_list as $company_trial_list)
                        <tr>
                          <td><input type="checkbox" name=""></td>
                          <td>{{$company_trial_list->name}}</td>
                          <td>{{$company_trial_list->company_name}}</td>
                          <td>{{$company_trial_list->email}}</td>
                          <td>{{$company_trial_list->mobile}}</td>
                          <td>{{$company_trial_list-> trial_duration}}</td>
                          <?php
                          
                            $added_date = \Carbon\Carbon::parse($company_trial_list->updated_at)->addDays($company_trial_list->trial_duration);
                            $today = \Carbon\Carbon::today()->addDays(0);
                            $due_date = $added_date->format('d-m-Y')
                          ?>
                          <td>{{$due_date}}</td>
                          @if($added_date >= $today)
                          <td style="color: green;">Trial</td>
                          @else
                          <td style="color: red;">Trial Expired</td>
                          @endif
                          <td>
                          <a href="{{URL::to('send-mail-trial-company/'.$company_trial_list->id)}}" title="Send Mail" class="btn btn-success btn-sm">Send Mail</a>
                          </td>
                        </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
              </div>                    
            </div> 
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