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
                    <p>{{ session('delete_success') }} &#10004; </p>
                </div> 
                @endif   
                  <table class="table table-hover" id="ajax_schedule_list">
                    <thead>
                      <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">ハッシュタグ</th>
                        <th scope="col" class="text-center">テンプレート</th>
                        <th scope="col" class="text-center">配信開始日</th>
                        <th scope="col" class="text-center">配信終了日</th>
                        <th scope="col" class="text-center">開始時刻</th>
                        <th scope="col" class="text-center">終了時刻</th>
                        <th scope="col" class="text-center">ステータス</th>
                        <th scope="col" class="text-center">アクション</th>
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
                          @if($schedule->status == 1 && $current_date >= $start_date && $current_date <= $end_date)
                          <td style="color: green;font-weight:bold;" class="text-center">配信中</td>
                          @elseif($current_date < $start_date)
                          <td style="color: #bbbb24;font-weight:bold;" class="text-center">保留中</td>
                          @elseif($schedule->status == 0 && $current_date >= $start_date && $current_date <= $end_date)
                          <td style="color: red;font-weight:bold;" class="text-center">停止中</td>
                          @else($current_date > $end_date)
                          <td style="color: red;font-weight:bold;" class="text-center">停止中</td>
                          @endif
                          <td class="text-center">
                            <form action="{{URL::to('schedule-action')}}" method="post">
                              {{csrf_field()}}
                              <input type="hidden" name="schedule_id" value="{{$schedule->s_id}}">
                              <input type="hidden" name="schedule_status" value="{{$schedule->status}}">
                              <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">

                              @if($schedule->status == 1 && $current_date >= $start_date && $current_date <= $end_date)
                              <!-- <input type="submit" name="" class="btn btn-danger btn-sm" value="Stop"> -->
                              <button type="button" name="btn" id="schedule_stop{{$schedule->s_id}}" class="btn btn-danger btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);">一時停止</button>

                              <!-- <button type="button" name="btn" id="schedule_start{{$schedule->s_id}}" class="btn btn-success btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);" style="display: none;">再開</button> -->

                              @elseif($current_date < $start_date && $schedule->status == 1)
                              <!-- <input type="submit" name="" class="btn btn-danger btn-sm" value="Stop"> -->
                              <button type="button" name="btn" id="schedule_stop{{$schedule->s_id}}" class="btn btn-danger btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);">一時停止</button>

                              @elseif($current_date < $start_date && $schedule->status == 0)
                              <!-- <input type="submit" name="" class="btn btn-danger btn-sm" value="Stop"> -->
                              <button type="button" name="btn" id="schedule_stop{{$schedule->s_id}}" class="btn btn-success btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);">再開</button>

                              @elseif($schedule->status == 0 && $current_date >= $start_date && $current_date <= $end_date)
                              <!-- <input type="submit" name="" class="btn btn-success btn-sm" value="Start"> -->
                              <button type="button" name="btn" id="schedule_start{{$schedule->s_id}}" class="btn btn-success btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);">再開</button>

                              @elseif($current_date > $end_date)
                              <button type="button" name="btn" id="schedule_start" class="btn btn-success btn-sm" value="{{$schedule->s_id}}" onclick="return schedule_expire_alert();">再開</button>

                              <!-- <button type="button" name="btn" id="schedule_stop{{$schedule->s_id}}" class="btn btn-danger btn-sm" value="{{$schedule->s_id}}" onclick="schedule_action(this.value);" style="display: none;">一時停止</button> -->
                              @endif
                              <a href="{{URL::to('schedule-delete/'.$schedule->s_id)}}" class="btn btn-danger btn-sm" onclick="return delete_schedule();">削除する</a>
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