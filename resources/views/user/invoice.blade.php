@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="progress_view">
                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>請求書
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

                        <tr>
                            <td>{{$i}}</td>
                            <td>Name</td>
                            <td>name@gmail.com</td>
                            <td>4</td>
                            <td>1</td>
                            <td>
                                <button type="button" name="btn" class="btn btn-success">Payment</button>
                            </td>
                        </tr>
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