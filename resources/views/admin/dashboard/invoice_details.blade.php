@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <!-- <div class="create_btn_holder">
            <div class="create_new_template">
                <span class="new_template">更新</span>
            </div>
        </div> -->
        <div class="row">

            <div class="col-md-12">

                <div class="progress_view">
                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Invoice Details
                    </h4>

                    @if(Session('payment_msg'))

                    <div class="alert alert-success">
                        {{Session('payment_msg')}}
                    </div>

                    @endif

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">請求番号</th>
                            <th scope="col">発行日</th>
                            <th scope="col">入金期限</th>
                            <th scope="col">ステータス</th>
                            <th scope="col">管理</th>
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
                            <?php
                                $issue_date = \Carbon\Carbon::parse($invoice->issue_date)->format('d-m-Y');
                                $due_date = \Carbon\Carbon::parse($invoice->due_date)->format('d-m-Y');
                            ?>
                            <td>{{$i}}</td>
                            <td>{{$invoice->invoice_id}}</td>
                            <td>{{$issue_date}}</td>
                            <td>{{$due_date}}</td>
                            <td>{{$invoice->billing_status}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Payment
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Send Mail</a>
                                        @if($invoice->billing_status == 'unpaid')
                                        <a class="dropdown-item" href="{{URL::to('payment-receive/'.Crypt::encrypt($invoice->invoice_id))}}">Received</a>
                                        @endif
                                        <a class="dropdown-item" href="#">Creat Invoice</a>
                                        <!-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated </a>
                                      </div> -->
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

<!--        <div class="envelope_area">-->
<!--            <div class="envelope">-->
<!--                <a href="#">-->
<!--                    <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    @endsection