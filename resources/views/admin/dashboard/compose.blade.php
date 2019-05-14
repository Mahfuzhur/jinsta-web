@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-6 create_form_sec">
                <div class="card">
                    <div class="card-body">


                        <form action="{{URL::to('admin-email-sent')}}" method="post" role="form" class="form-horizontal"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h4 class="progress_margin"><span><img src="{{asset('assets/img/mail.png')}}" alt=""></span>Mail</h4>
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
                                    {{ session('add_success') }}
                                </div>
                                @endif
                                @if(session('empty_msg'))
                                <div class="alert alert-success">
                                    {{ session('empty_msg') }}
                                </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">宛先</label>
                                    <div class=" email col-lg-10" style="border: 1px solid #ced4da; margin-left: 2%">
                                        @foreach($emails as $email)
                                        {{$email}},
                                        @endforeach
                                    </div>
                                    @foreach($emails as $email)
                                       <input type="hidden" name="email[]" value="{{$email}}">
                                   @endforeach
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">件名</label>
                                    <div class="col-lg-10">
                                        <input type="text" placeholder="Subject" id="text" name="subject"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Message</label>
                                    <div class="col-lg-10" style="#ced4da;">
                                        <textarea rows="10" cols="30" class="form-control" id="text1" name="body"
                                                  placeholder="mail body"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                        <span>Attachment</span>
                                                        <input type="file" name="file" multiple="">
                                                      </span>
                                        <button class="btn btn-send" type="submit">Send</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection