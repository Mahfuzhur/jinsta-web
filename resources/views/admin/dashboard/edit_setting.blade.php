@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <form action="{{URL::to('update-setting/'.$single_setting_info->id)}}" method="post">
                    {{csrf_field()}}
                <div class="progress_view">
                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/settings.jpg')}}" alt=""></span>
                        Setting
                    </h4>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Trial Period</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="trial_period" value="{{$single_setting_info->trial_period}}" placeholder="Enter trial period">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Invoice Grace Time</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="invoice_grace_time" value="{{$single_setting_info->invoice_grace_time}}" placeholder="Enter Invoice Grace Time">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Message Rate ( <span style="font-size: 20px;">¥</span> )</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="message_rate" value="{{$single_setting_info->message_rate}}" placeholder="Enter Message Send Rate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Demo1</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="demo1" placeholder="Demo1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Demo2</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="demo2" placeholder="Demo2">
                        </div>
                    </div>


                    <div style="margin-left: 43%">
                        <button onclick="return confirm('Do you really want to Update this item?');"       type="submit" class="btn btn-success"
                        data-original-title="Delete Item" data-toggle="tooltip"
                        data-placement="top" title="">Update
                        </button>
                    </div>
                </div>
                </form>               
            </div>
        </div>
    </div>
</div>
@endsection