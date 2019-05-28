@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row create_destination">
            <form role="form" method="POST" action="{{ URL::to('check-update-instagram-info') }}">
                  {{ csrf_field() }}
                    <div class="box_title">
                        <h4>宛先リスト名：テストテストテスト</h4>
                        @if(session('check'))
                        <div class="alert alert-danger">
                            {{ session('check') }}
                        </div>
                        @endif
                        @if(session('success_msg'))
                        <div class="alert alert-success">
                            <p>{{ session('success_msg') }} &#10004; </p>
                        </div>
                        @endif
                    </div><br>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Instagramユーザーネーム</label>
                      <input type="name" class="form-control" name="email" id="email" placeholder="Username" value=""  required="">
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password">Instagramパスワード</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>パスワードは6文字以上で設定をお願いします。</strong>
                          </span>
                      @endif
                    </div>

                    <div class="button_holder">                      
                      <button type="submit" class="btn registration_btn">Update</button>                      
                    </div>
                    
                </form>
            <!-- <form method="post" action="{{URL::to('hashtag-search')}}">
                {{ csrf_field() }}
                <div class="hashtag_title left-border m-b-40">
                    <h4>#から作成</h4>
                    <div class="input_box">
                        <label for="hastag">
                            #から作成
                        </label>
                        <input type="text" name="hashtag" id="hashtag" class="hashtag_input ">
                        <button type="submit">search</button>
                    </div>

                </div>
            </form>
            @if(isset($results))
            @foreach($results as $result)
            {{$result->name}}
             **
            {{$result->search_result_subtitle}} = <a href="download-csv/{{$result->name}}">select</a> -->
            <!-- <a href="hashtag-selected/{{$result->name}}">select</a> -->
            <!-- <br> -->
            <!-- @endforeach
            @endif -->
            <div class="success_progress_holder progress-container">
                <p class="s_message">Do not close your browser!<br>Wait until your request is processed! <br>This might
                    take a
                    few minutes!</p>
                <div class="loader"></div>
            </div>
<!--            <div class="envelope_area">-->
<!--                <div class="envelope">-->
<!--                    <a href="#">-->
<!--                        <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->

        </div>
    </div>
    @endsection