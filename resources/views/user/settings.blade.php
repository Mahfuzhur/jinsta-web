@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="progress_view">
                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/settings.jpg')}}" alt=""></span>
                        設定
                    </h4>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Trial Period</label>
                        <div class="col-6">
                            <input type="text" class="form-control" value="Enter trial period">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Invoice Grace Time</label>
                        <div class="col-6">
                            <input type="text" class="form-control" value="Enter Invoice Grace Time">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Message Send Rate</label>
                        <div class="col-6">
                            <input type="text" class="form-control" value="Enter Message Send Rate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Lorem Ispum</label>
                        <div class="col-6">
                            <input type="text" class="form-control" value="Lorem Ispum">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Trial Period</label>
                        <div class="col-6">
                            <input type="text" class="form-control" value="Lorem Ispum">
                        </div>
                    </div>

                    <div style="margin-left: 60%">

                        <button onclick="return confirm('Do you really want to Save this item?');"
                                type="submit" class="btn btn-success"
                                data-original-title="Delete Item" data-toggle="tooltip"
                                data-placement="top" title="">Save
                        </button>
<!--                        <button onclick="myFunction()">Click me</button>-->
                        
<!--                        <button onclick="return confirm('Do you really want to Save this item?');"-->
<!--                                type="submit" class="btn btn-success"-->
<!--                                data-original-title="Delete Item" data-toggle="tooltip"-->
<!--                                data-placement="top" title="">Save-->
<!--                        </button>-->
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection