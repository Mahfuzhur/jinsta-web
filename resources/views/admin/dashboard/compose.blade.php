@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-sm-6" style="margin-left: 7%">
                <div class="card">
                    <div class="card-body">


                        <form action="{{URL::to('admin-email-sent')}}" method="post" role="form" class="form-horizontal"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <h4 class="progress_margin"><span><img src="{{asset('assets/img/mail2.png')}}" alt=""></span>Mail
                            </h4>

<!--                            <i class="fa fa-envelope" style="color:#80dfdb">Mail</i>-->
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
                                <div style="margin-left: 13%">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">宛先</label>
                                        <div class=" email col-lg-10"
                                             style="border: 1px solid #ced4da; margin-left: 2%">
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
                                                  placeholder=""></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                                      <!-- <span class="btn green fileinput-button">
                                                        <i class="fa fa-plus fa fa-white"></i>
                                                        <span>Attachment</span>
                                                        <input type="file" name="file" multiple="">
                                                      </span> -->
                                                      <input type="file" name="file" id="file-upload" multiple required />
                                                      <i class="fa fa-plus fa fa-white"></i><label for="file-upload">Attachment</label>
                                                      <button class="btn btn-send pull-right" type="submit">Send</button>
                                                      <div id="file-upload-filename"></div>
                                            
                                        </div>
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
<style type="text/css">
    input[type="file"] { 
      z-index: -1;
      position: absolute;
      opacity: 0;
    }
</style>
<script type="text/javascript">
    var input = document.getElementById( 'file-upload' );
var infoArea = document.getElementById( 'file-upload-filename' );

input.addEventListener( 'change', showFileName );

function showFileName( event ) {
  
  // the change event gives us the input it occurred in 
  var input = event.srcElement;
  
  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
  var fileName = input.files[0].name;
  
  // use fileName however fits your app best, i.e. add it into a div
  infoArea.textContent = 'File name: ' + fileName;
}
</script>
@endsection