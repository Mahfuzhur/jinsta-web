@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                
                <div class="progress_view">
                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/settings.jpg')}}" alt=""></span>
                        Setting
                    </h4>
                    @if(!isset($single_setting_info))
                    <form action="{{URL::to('add-setting')}}" method="post">
                        {{csrf_field()}}
                        
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Trial Period</label>
                            <div class="col-4">
                                <input type="text" class="form-control" name="trial_period" placeholder="Enter trial period">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Invoice Grace Time</label>
                            <div class="col-4">
                                <input type="text" class="form-control" name="invoice_grace_time" placeholder="Enter Invoice Grace Time">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Message Rate ( <span style="font-size: 20px;">¥</span> )</label>
                            <div class="col-4">
                                <input type="text" class="form-control" name="message_rate" placeholder="Enter Message Send Rate">
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
                            <button onclick="return confirm('Do you really want to Save this item?');"
                                    type="submit" class="btn btn-success"
                                    data-original-title="Delete Item" data-toggle="tooltip"
                                    data-placement="top" title="">Save
                            </button>
                        </div>
                    </form>
                    <hr>
                    @endif
                </div>
                @if(session('add_msg'))
                <div class="alert alert-success"> 
                    {{session('add_msg')}}
                </div>
                @endif
                
                @if(session('update_msg'))
                <div class="alert alert-success">
                    {{session('update_msg')}}
                </div>
                @endif

                @if(isset($single_setting_info))
                <table class="table table-hover">
                    <th>Trial Period</th>
                    <th>Invoice Grace Time</th>
                    <th>Message Rate</th>
                    <th>Action</th>

                    <tr>
                        <td>{{$single_setting_info->trial_period}}</td>
                        <td>{{$single_setting_info->invoice_grace_time}}</td>
                        <td>{{$single_setting_info->message_rate}}</td>
                        <td><a href="{{URL::to('edit-setting/'.$single_setting_info->id)}}" class="btn btn-success btn-sm">Edit</a></td>
                    </tr>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection