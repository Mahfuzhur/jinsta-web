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
                        <th scope="col">Hashtag</th>
                        <th scope="col">Template</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
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
                      @if(isset($all_schedule))
                        @foreach($all_schedule as $schedule)
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{$schedule->hashtag}}</td>
                          <td>{{$schedule->title}}</td>
                          <td>{{$schedule->delivery_period_start}}</td>
                          <td>{{$schedule->delivery_period_end}}</td>
                          <?php
                            $start_time = \Carbon\Carbon::parse($schedule->specify_time_start)->addHour(9)->format('H:i');
                            $end_time = \Carbon\Carbon::parse($schedule->specify_time_end)->addHour(9)->format('H:i');
                          ?>
                          <td>{{$start_time}}</td>
                          <td>{{$end_time}}</td>
                          <td>
                            <form action="{{URL::to('schedule-action')}}" method="post">
                              {{csrf_field()}}
                              <input type="hidden" name="schedule_id" value="{{$schedule->s_id}}">
                              <input type="hidden" name="schedule_status" value="{{$schedule->status}}">
                              <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">

                              @if($schedule->status == 1)
                              <!-- <input type="submit" name="" class="btn btn-danger btn-sm" value="Stop"> -->
                              <button type="button" name="btn" id="schedule_stop{{$schedule->s_id}}" class="btn btn-danger btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);">Stop</button>

                              <button type="button" name="btn" id="schedule_start{{$schedule->s_id}}" class="btn btn-success btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);" style="display: none;">Start</button>

                              @elseif($schedule->status == 0)
                              <!-- <input type="submit" name="" class="btn btn-success btn-sm" value="Start"> -->
                              <button type="button" name="btn" id="schedule_start{{$schedule->s_id}}" class="btn btn-success btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);">Start</button>

                              <button type="button" name="btn" id="schedule_stop{{$schedule->s_id}}" class="btn btn-danger btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);" style="display: none;">Stop</button>
                              @endif
                              <a href="{{URL::to('schedule-delete/'.$schedule->s_id)}}" class="btn btn-danger btn-sm">Delete</a>
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
        
        <div class="envelope_area">
           <div class="envelope">
              <a href="#">
                <img src="{{asset('assets/img/message64.png')}}" alt="">
              </a>
           </div>
        </div>           
  </div>
@endsection