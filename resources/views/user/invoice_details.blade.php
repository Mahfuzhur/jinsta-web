@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="create_btn_holder">
            <div class="create_new_template">
                <span class="new_template">更新</span>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">

                <div class="progress_view">
                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>請求の詳細
                    </h4>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Invoice No.</th>
                            <th scope="col">Issue Date</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (isset($_GET['page'])) {
                            $i = ($_GET['page'] * 10) - 9;
                        } else {
                            $i = 1;
                        }

                        ?>
                        @foreach($invoice as $invoice)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$invoice->id}}</td>
                            <td>{{$invoice->issue_date}}</td>
                            <td>{{$invoice->due_date}}</td>
                            <td>{{$invoice->billing_status}}</td>
                            <td>
                                <button type="button" name="btn" class="btn btn-success">Payment</button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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
    </div>
    @endsection