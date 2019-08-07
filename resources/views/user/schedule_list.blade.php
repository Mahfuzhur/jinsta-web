@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

              <div class="progress_view">
                <h4 class="progress_margin"> <span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Schedule List</h4>
                @if(session('delete_success'))
                <div class="alert alert-success">
                    <p>{{ session('delete_success') }} &#10004; </p>
                </div> 
                @endif   
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Hashtag</th>
                        <th scope="col" class="text-center">Template</th>
                        <th scope="col" class="text-center">Delivery Start Date</th>
                        <th scope="col" class="text-center">Delivery End Date</th>
                        <th scope="col" class="text-center">Start time</th>
                        <th scope="col" class="text-center">End Time</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(isset($_GET['page'])){
                          $i = ($_GET['page']*10)-9;
                        }else{
                          $i = 1;
                        }

                        // $date = \Carbon\Carbon::today()->format('d-m-Y');
                        // echo $date;
                        // exit();
                        
                      ?>
                      @if(isset($all_schedule))
                        @foreach($all_schedule as $schedule)
                        <tr>
                          <td class="text-center">{{$i}}</td>
                          <td class="text-center">{{$schedule->hashtag}}</td>
                          <td class="text-center">{{$schedule->title}}</td>
                          <td class="text-center">{{$schedule->delivery_period_start}}</td>
                          <td class="text-center">{{$schedule->delivery_period_end}}</td>
                          <?php
                          $current_date = \Carbon\Carbon::today()->format('Y-m-d');
                          $start_date = \Carbon\Carbon::parse($schedule->delivery_period_start)->format('Y-m-d');
                          $end_date = \Carbon\Carbon::parse($schedule->delivery_period_end)->format('Y-m-d');

                          // echo $current_date.','.$start_date.','.$end_date;
                          // exit();
                            $start_time = \Carbon\Carbon::parse($schedule->specify_time_start)->addHour(9)->format('H:i');
                            $end_time = \Carbon\Carbon::parse($schedule->specify_time_end)->addHour(9)->format('H:i');
                          ?>
                          <td class="text-center">{{$start_time}}</td>
                          <td class="text-center">{{$end_time}}</td>
                          @if($current_date >= $start_date && $current_date <= $end_date)
                          <td style="color: green;font-weight:bold;" class="text-center">Running</td>
                          @elseif($current_date < $start_date)
                          <td style="color: #bbbb24;font-weight:bold;" class="text-center">On Hold</td>
                          @else($current_date > $end_date)
                          <td style="color: red;font-weight:bold;" class="text-center">Expired</td>
                          @endif
                          <td class="text-center">
                            <form action="{{URL::to('schedule-action')}}" method="post">
                              {{csrf_field()}}
                              <input type="hidden" name="schedule_id" value="{{$schedule->s_id}}">
                              <input type="hidden" name="schedule_status" value="{{$schedule->status}}">
                              <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">

                              @if($schedule->status == 1)
                              <!-- <input type="submit" name="" class="btn btn-danger btn-sm" value="Stop"> -->
                              <button type="button" name="btn" id="schedule_stop{{$schedule->s_id}}" class="btn btn-danger btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);">Stop</button>

                              <button type="button" name="btn" id="schedule_start{{$schedule->s_id}}" class="btn btn-success btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);" style="display: none;">Delete</button>

                              @elseif($schedule->status == 0)
                              <!-- <input type="submit" name="" class="btn btn-success btn-sm" value="Start"> -->
                              <button type="button" name="btn" id="schedule_start{{$schedule->s_id}}" class="btn btn-success btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);">Start</button>

                              <button type="button" name="btn" id="schedule_stop{{$schedule->s_id}}" class="btn btn-danger btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);" style="display: none;">Stop</button>
                              @endif
                              <a href="{{URL::to('schedule-delete/'.$schedule->s_id)}}" class="btn btn-danger btn-sm" onclick="return confirm_click();">Delete</a>
                            </form>
                            
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
                {{$all_schedule->links()}}                         
                </ul>
              </nav> 
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