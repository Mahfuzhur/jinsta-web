@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="progress_view">
                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Invoice
                    </h4>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Company</th>
                            <th scope="col">Email</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Unpaid</th>
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

                        @if(isset($all_company))
                        @foreach($all_company as $company)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$company->company_name}}</td>
                                <td>{{$company->email}}</td>
                                <?php                               
                                    $paid_invoice = DB::table('invoice')->where([['user_id',$company->id],['billing_status','paid']])->count();
                                    $unpaid_invoice = DB::table('invoice')->where([['user_id',$company->id],['billing_status','unpaid']])->count();
                                ?>
                                <td>{{$paid_invoice}}</td>
                                <td>{{$unpaid_invoice}}</td>
                                <td>
                                    <!-- <button type="button" name="btn" class="btn btn-success">Details</button> -->
                                    <a href="{{URL::to('invoice-details/'.Crypt::encrypt($company->id))}}" class="btn btn-success">Details</a>
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

        <div class="envelope_area">
            <div class="envelope">
                <a href="#">
                    <img src="{{asset('assets/img/message64.png')}}" alt="">
                </a>
            </div>
        </div>
    </div>
</div>
@endsection