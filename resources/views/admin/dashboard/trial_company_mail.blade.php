@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 col-sm-6 create_form_sec">
                <form action="{{URL::to('send-mail-trial-company')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box_title">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(session('add_success'))
                        <div class="alert alert-success">
                            <p>{{ session('add_success') }} &#10004; </p>
                        </div>
                        @endif
                        @if(session('empty_msg'))
                        <div class="alert alert-success">
                            <p>{{ session('empty_msg') }} &#10004; </p>
                        </div>
                        @endif
                        <!-- <h4>テンプレート名：テストテストテスト</h4> -->
                        <label for="temp_regi">
                            To :
                        </label>
                        <div class="email">
                            @foreach($emails as $email)
                            {{$email}},
                            @endforeach
                        </div>
                        @foreach($emails as $email)
                        <input type="hidden" name="email[]" value="{{$email}}">
                        @endforeach

                        <label for="temp_regi">

                        </label>
                        <input type="text" class="form-control title" id="text" name="subject" maxlength="170"
                               placeholder="subject" rows="5">

                    </div>
                    <div class="m-b-35">
                        <div class="input_box">
                            <label for="temp_regi">
                                テキスト登録
                            </label>
                            <textarea class="form-control" id="text1" name="body" maxlength="170"
                                      placeholder="mail body" rows="5"></textarea>
                            <span class="pull-right label label-default" id="count_message"></span>
                        </div>
                    </div>
                    <div class="img_reg_upload">
                        <div class="input_box">
                            <label for="file">
                                <span><i class="fa fa-download" aria-hidden="true"></i></span>
                                <span style="font-size: 13px;">画像登録(推奨画像サイズ：横1200px×縦600px)</span>

                            </label>
                            <input type="file" name="file" id="file" class="inputfile csv_input"
                                   data-multiple-caption="{count} files selected" multiple="">
                            <img src="{{asset('assets/img/No_Image_Available.jpg')}}" id="image_show_small" alt="Image"
                                 style="width:100px;height: 50px;">
                            <!-- <img id="image_show_small" src="#" alt="your image" /> -->
                            <!-- <span class="image_show_small"></span>  -->

                        </div>
                        <div class="form_buttons">
                            <!-- <input class="btn_cancel p_btn" type="submit" value="削除する"> -->
                            <input class="btn_done p_btn" type="submit" value="登録する">
                        </div>
                    </div>

            </div>
            </form>

        </div>

        <!--        <div class="envelope_area">-->
        <!--            <div class="envelope">-->
        <!--                <a href="#">-->
        <!--                    <img src="{{asset('assets/img/message64.png')}}" alt="">-->
        <!--                </a>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
</div>
@endsection