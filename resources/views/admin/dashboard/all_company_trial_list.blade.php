@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

              <div class="progress_view">
                <h4 class="progress_margin"> <span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>All Trial List</h4> 
                <form action="{{URL::to('compose-mail-trial-company')}}" method="post">
                  {{csrf_field()}}
                
                <div style="margin-bottom: 15px;margin-left: 10px;">
                  <input type="checkbox" name="email" onchange="ckeckalltrialcompany(this);"  style="width: 20px;height: 20px;margin-left: 10px;"> <span style="font-weight: bold; font-size: 20px;padding-left: 5px;">すべて選択</span>
                  <button type="submit" class="btn btn-success btn-sm pull-right" style="background: #06af94; float:right">メールを送る</button>
                </div>
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">名</th>
                        <th scope="col" class="text-center">会社名</th>
                        <th scope="col" class="text-center">メールアドレス</th>
                        <th scope="col" class="text-center">試用期間</th>
                        <th scope="col" class="text-center">トレイル期間</th>
                        <th scope="col" class="text-center">有効期限</th>
                        <th scope="col" class="text-center">状態</th>
                        <!-- <th scope="col">Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($all_company_trial_list))
                        @foreach($all_company_trial_list as $company_trial_list)
                        <tr>
                          <td class="text-center"><input type="checkbox" name="email[]" value="{{$company_trial_list->email}}"></td>
                          <td class="text-center">{{$company_trial_list->name}}</td>
                          <td class="text-center">{{$company_trial_list->company_name}}</td>
                          <td class="text-center">{{$company_trial_list->email}}</td>
                          <td class="text-center">{{$company_trial_list->mobile}}</td>
                          <td class="text-center">{{$trial_period->trial_period}}</td>
                          <?php
                          
                            $added_date = \Carbon\Carbon::parse($company_trial_list->updated_at)->addDays($trial_period->trial_period);
                            $today = \Carbon\Carbon::today()->addDays(0);
                            $due_date = $added_date->format('d-m-Y')
                          ?>
                          <td class="text-center">{{$due_date}}</td>
                          @if($added_date >= $today)
                          <td style="color: green;" class="text-center">Trial</td>
                          @else
                          <td style="color: red;" class="text-center">Trial Expired</td>
                          @endif
                          <!-- <td>
                          <a href="{{URL::to('send-mail-trial-company/'.$company_trial_list->id)}}" title="Send Mail" class="btn btn-success btn-sm">Send Mail</a>
                          </td> -->
                        </tr>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                  </form>
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

  <script type="text/javascript">
    
    function ckeckalltrialcompany(e){
      var all_checkbox_list = document.getElementsByName('email[]');

      console.log(all_checkbox_list);

      if(e.checked){
        for (var i = 0;i < all_checkbox_list.length; i++) {
          all_checkbox_list[i].checked = true;
        }
      }else{
        for (var i = 0; i < all_checkbox_list.length; i++) {
          all_checkbox_list[i].checked = false;
        }
      }

    }

  </script>
@endsection