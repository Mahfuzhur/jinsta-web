@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">
                @if(session('invoice'))
                <div class="alert alert-success">
                    {{ session('invoice') }}
                </div>
                @endif
                <div class="progress_view">
                    <!-- <form action="{{URL::to('create-bill')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Create Invoice</label>
                            <div class="col-4">
                                <select name="month" class="form-control">
                                    <option value="1">January {{ date('Y') }}</option>
                                    <option value="2">February {{ date('Y') }}</option>
                                    <option value="3">March {{ date('Y') }}</option>
                                    <option value="4">April {{ date('Y') }}</option>
                                    <option value="5">May {{ date('Y') }}</option>
                                    <option value="6">June {{ date('Y') }}</option>
                                    <option value="7">July {{ date('Y') }}</option>
                                    <option value="8">August {{ date('Y') }}</option>
                                    <option value="9">September {{ date('Y') }}</option>
                                    <option value="10">October {{ date('Y') }}</option>
                                    <option value="11">November {{ date('Y') }}</option>
                                    <option value="12">December {{ date('Y') }}</option>
                                </select>
                                <input name="user_id" value="{{$user_id}}" type="hidden">

                            </div>
                        </div>
                        <button type="submit">submit</button>
                    </form> -->

                    <div class="create_btn_holder">
                        <div class="create_invoice_details">
                            <span class="new_template">{{$user_info->name}}</span><br>
                            <span class="new_template">{{$user_info->company_name}}</span><br>
                            <span class="new_template">{{$user_info->mobile}}</span><br>
                            <span class="new_template">{{$user_info->email}}</span><br>
                            
                            <a href="" class="btn btn-success" style="width: 100%;margin-top: 10px;">Update</a>
                        </div>
                    </div>

                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Invoice Details
                    </h4>

                    @if(Session('payment_msg'))

                    <div class="alert alert-success">
                        {{Session('payment_msg')}}
                    </div>

                    @endif
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">請求番号</th>
                            <th scope="col" class="text-center">発行日</th>
                            <th scope="col" class="text-center">入金期限</th>
                            <th scope="col" class="text-center">送信メッセージ</th>
                            <th scope="col" class="text-center">ステータス</th>
                            <th scope="col" class="text-center">管理</th>


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
                            <td class="text-center">{{$i}}</td>
                            <td class="text-center">{{$invoice->invoice_id}}</td>
                            <td class="text-center">{{$invoice->issue_date}}</td>
                            <td class="text-center">{{$invoice->due_date}}</td>
                            <td class="text-center">{{$invoice->dm_total_number}}</td>
                            @if($invoice->billing_status == 1)
                            <td style="color: green;" class="text-center">入金済</td>
                            @elseif($invoice->billing_status == 0)
                            <td style="color: red;" class="text-center">未入金</td>
                            @endif
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Payment
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Send Mail</a>
                                        @if($invoice->billing_status == 0)
                                        <a class="dropdown-item" href="{{URL::to('payment-receive/'.Crypt::encrypt($invoice->invoice_id))}}">Received</a>
                                        @endif
                                        <a class="dropdown-item" href="#">Print Invoice</a>
                                        <!-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated </a>
                                      </div> -->
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php $i++;?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
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