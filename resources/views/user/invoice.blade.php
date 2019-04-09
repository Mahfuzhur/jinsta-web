@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="create_btn_holder">
                <div class="create_new_template">
                    <span><i class="fa fa-plus" aria-hidden="true"></i></span>
                    <span class="new_template">更新</span>
                </div>
        </div>
    </div>
</div>
<div class="envelope_area">
    <div class="envelope">
        <a href="#">
            <img src="{{asset('assets/img/message64.png')}}" alt="">
        </a>
    </div>
</div>

@endsection