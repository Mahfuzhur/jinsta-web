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
                                <option>請求月を選択してください。</option>
                                <option value="1">{{ date('Y') }}年 1月</option>
                                <option value="2">{{ date('Y') }}年 2月</option>
                                <option value="3">{{ date('Y') }}年 3月</option>
                                <option value="4">{{ date('Y') }}年 4月</option>
                                <option value="5">{{ date('Y') }}年 5月</option>
                                <option value="6">{{ date('Y') }}年 6月</option>
                                <option value="7">{{ date('Y') }}年 7月</option>
                                <option value="8">{{ date('Y') }}年 8月</option>
                                <option value="9">{{ date('Y') }}年 9月</option>
                                <option value="10">{{ date('Y') }}年 10月</option>
                                <option value="11">{{ date('Y') }}年 11月</option>
                                <option value="12">{{ date('Y') }}年 12月</option>
                            </select>
                            <input name="year" value="{{ date('Y') }}" type="hidden">

                        </div>
                        <div class="col-4" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-success">詳細</button>
                        </div>

                    </div>


                </form>

                @if(isset($invoice))
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
                          <li><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""> </span>送信回数：{{$numberSent}}</li>
                          <li><span><img src="{{asset('assets/img/iconsshade333.png')}}" alt=""> </span> 送信単価：¥{{$numberSent*$message_rate->message_rate}}</li>
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