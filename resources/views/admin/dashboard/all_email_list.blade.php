@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

              <div class="progress_view">
                <h4 class="progress_margin"> <span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Mail List</h4>   
                @if(session('delete_success'))
                <div class="alert alert-success">
                  {{ session('delete_success') }}
                </div> 
                @endif 
                <div style="margin-bottom: 15px;margin-left: 10px;">
                  <input type="checkbox" name="email"> <span style="font-weight: bold;">Select All</span>
                </div>
                 
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Mark</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
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
                      @if(isset($all_user_email))
                        @foreach($all_user_email as $user_email)
                        <tr>
                          <td><input type="checkbox" name="email"></td>
                          <td>{{$user_email->company_name}}</td>
                          <td>{{$user_email->name}}</td>
                          <td>{{$user_email->email}}</td>
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
                {{$all_user_email->links()}}                         
                </ul>
              </nav> 

              <div>
                <button class="btn btn-success btn-sm">Compose Mail</button>
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