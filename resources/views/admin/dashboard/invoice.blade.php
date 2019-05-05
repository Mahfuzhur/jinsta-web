@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="progress_view">
                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Invoice
                    </h4>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">会社名</th>
                            <th scope="col" class="text-center">メールアドレス</th>
                            <th =scope="col" class="text-center">支払済</th>
                            <th scope="col" class="text-center">未払い</th>
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

                        @if(isset($all_company))
                        @foreach($all_company as $company)
                            <tr>
                                <td class="text-center">{{$i}}</td>
                                <td class="text-center">{{$company->company_name}}</td>
                                <td class="text-center">{{$company->email}}</td>
                                <?php                               
                                    $paid_invoice = DB::table('invoice')->where([['user_id',$company->id],['billing_status',1]])->count();
                                    $unpaid_invoice = DB::table('invoice')->where([['user_id',$company->id],['billing_status',0]])->count();
                                ?>
                                <td class="text-center">{{$paid_invoice}}</td>
                                <td class="text-center">{{$unpaid_invoice}}</td>
                                <td class="text-center">
                                    <!-- <button type="button" name="btn" class="btn btn-success">Details</button> -->
                                    <a href="{{URL::to('invoice-details/'.Crypt::encrypt($company->id))}}" class="btn btn-success">詳細</a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        ?>
                        @endforeach
                        @endif
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
</div>
@endsection