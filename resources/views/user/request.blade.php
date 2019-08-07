@extend('master)
@section('user_main_content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 request">
                @if(!empty($message))
                <div class="alert alert-danger">
                    <p> {{ $message }}  </p>
                </div>
                @endif
                <form action="{{URL::to('show-bill')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <!-- <label class="col-2 col-form-label">Create Invoice</label> -->
                        <h4 class="progress_margin" style="margin-top: 20px;"><span style="margin-left: 15px;"><img
                                        src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Invoice</h4>
                        <div class="col-4" style="margin-top: 20px;">
                            <select name="month" class="form-control" style="box-shadow: 1px 2px 10px #e2dede;">
                                <option>Please Select a Billing Month.</option>
                                <option value="1">{{ date('Y') }} January</option>
                                <option value="2">{{ date('Y') }} February</option>
                                <option value="3">{{ date('Y') }} March</option>
                                <option value="4">{{ date('Y') }} April</option>
                                <option value="5">{{ date('Y') }} May</option>
                                <option value="6">{{ date('Y') }} June</option>
                                <option value="7">{{ date('Y') }} July</option>
                                <option value="8">{{ date('Y') }} August</option>
                                <option value="9">{{ date('Y') }} September</option>
                                <option value="10">{{ date('Y') }} October</option>
                                <option value="11">{{ date('Y') }} November</option>
                                <option value="12">{{ date('Y') }} December</option>
                            </select>
                            <input name="year" value="{{ date('Y') }}" type="hidden">

                        </div>
                        <div class="col-4" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-success">Details</button>
                        </div>

                    </div>


                </form>

                @if(isset($invoice))
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Billing Number</th>
                            <th scope="col" class="text-center">Issue Date</th>
                            <th scope="col" class="text-center">Payment Deadline</th>
                            <th scope="col" class="text-center">Send Message</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Management</th>


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
                            <td style="color: green;font-weight:bold;" class="text-center">入金済</td>
                            @elseif($invoice->billing_status == 0)
                            <td style="color: red;font-weight:bold;" class="text-center">未入金</td>
                            @endif
                            <td class="text-center">
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-success">
                                        Print
                                    </button> -->
                                    <a href="{{URL::to('user-create-invoice/'.Crypt::encrypt($invoice->user_id).'/'.Crypt::encrypt($invoice->invoice_id))}}" class="btn btn-success" target="_blank">Print</a>

                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>

                        </tbody>
                    </table>
                </div>
                @endif
                <div class="dash_footer">
                    <span class="total">
                        <ul>
                          <li><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""> </span>The Number of Transmissions：{{$numberSent}}</li>
                          <li><span><img src="{{asset('assets/img/iconsshade333.png')}}" alt=""> </span> Send Bid：¥{{$numberSent*$message_rate->message_rate}}</li>
                        </ul>
                        <!--<div class="last_request_list">-->
                        <!--  <p>ご請求金額：¥---</p>-->
                        <!--</div>-->
                    </span>
                </div>
                <!--<div class="request_upload">-->
                <!--    <div class="input_box">-->
                <!--        <label for="file">                          -->
                <!--            <span><i class="fa fa-download" aria-hidden="true"></i></span>-->
                <!--            <span>画像登録</span>                          -->
                <!--        </label>-->
                <!--        <input type="file" name="file[]" id="file" class="inputfile csv_input" data-multiple-caption="{count} files selected" multiple="">-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
<!--        <div class="envelope_area">-->
<!--             <div class="envelope">-->
<!--                <a href="#">-->
<!--                  <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--                </a>-->
<!--             </div>-->
<!--          </div>                          -->
    </div>
</div>
@endsection