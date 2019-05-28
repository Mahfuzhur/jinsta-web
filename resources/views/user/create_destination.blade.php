@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row create_destination">
            <form action="{{URL::to('save-hashtag-info')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="col-sm-12 main_content">
                    <div class="box_title">
                        <h4>宛先リスト名：テストテストテスト</h4>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if ( Session::has('success') )
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('success') }}  &#10004; </strong>
                    </div>
                    @endif
                    @if ( Session::has('error') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('error') }}</strong>
                    </div>
                    @endif
                    @if ( Session::has('error_msg') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('error_msg') }}</strong>
                    </div>
                    @endif
                    <div class="hashtag_title left-border m-b-40">
                        <h4>#から作成</h4>
                        <div class="input_box">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id=""><i class="fa fa-plus-circle"></i></span>
                                </div>
                                <input type="text" name="hashtag" id="hashtag" placeholder="#から作成"
                                       class="hashtag_input form-control" required="">
                            </div>
                        </div>

                    </div>
                    <div class="hashtag_title left-border m-b-40">
                        <h4 class="">csvファイルのアップロード</h4>
                        <div class="input_box">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id=""><i class="fa fa-upload"></i></span>
                                </div>
                                <input type="file" name="file" id="file" class="inputfile csv_input"
                                   data-multiple-caption="{count} files selected" multiple="">
                            </div>
                            <!-- <label for="file">
                                <span><i class="fa fa-upload"></i></span>
                            </label>
                            <input type="file" name="file" id="file" class="inputfile csv_input"
                                   data-multiple-caption="{count} files selected" multiple=""> -->
                        </div>
                    </div>

                    <div class="hashtag_title left-border m-b-40">
                        <h4>個別入力</h4>
                        <div class="input_box">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id=""><i class="fa fa-pencil"></i></span>
                                </div>
                                <input type="text" name="id" id="id" placeholder="コンマ（、）で区切られたIDを与える" class="id_input form-control">
                            </div>
                        </div>
                    </div>


                    <div class="form_buttons">
                        <!-- <button class="btn_cancel p_btn">削除する</button> -->
                        <button type="submit" class="btn_done p_btn">登録する</button>
                    </div>
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