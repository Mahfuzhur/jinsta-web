@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">
                @if(Session('update_extra_info'))
                    <div class="alert alert-success">
                        <p>{{ session('update_extra_info') }} &#10004; </p>
                   </div>
                @endif

                @if(session('invoice'))
                <div class="alert alert-success">
                    <p>{{ session('invoice') }} &#10004; </p>
                </div>
                @endif
                <div class="progress_view">
                    <form action="{{URL::to('create-bill')}}" method="post">
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
                                    <option value="3">{{ date('Y') }} March </option>
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
                                <input name="user_id" value="{{$user_id}}" type="hidden">

                            </div>
                            <div class="col-4" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-success">Details</button>
                            </div>

                        </div>


                    </form>

                    <div class="create_btn_holder" >
                        @if(isset($user_info))
                        <div class="create_invoice_details">
                            
                            <span class="new_template">{{$user_info->name}}</span><br>
                            <span class="new_template">{{$user_info->company_name}}</span><br>
                            <span class="new_template">{{$user_info->contact_number}}</span><br>
                            <span class="new_template">{{$user_info->street}}</span><br>
                            <span class="new_template">{{$user_info->postal_code}}</span><br>

                            <!-- <a href="{{URL::to('edit-user-extra-info/'.Crypt::encrypt($user_info->id))}}" class="btn btn-success"
                               style="width: 100%;margin-top: 10px; color: white">Update</a> -->
                               <button type="button" class="btn btn-success" style="width: 100%;margin-top: 10px; color: white" data-toggle="modal" data-target="#exampleModal">請求書情報編集</button>

                            
                        </div>
                        @endif
                    </div>

                    <h4 class="progress_margin"><span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Invoice
                        Details
                    </h4>

                    @if(Session('payment_msg'))

                    <div class="alert alert-success">
                        {{Session('payment_msg')}}
                    </div>

                    @endif

                    @if(Session('invoice_mail_success'))

                    <div class="alert alert-success">
                        {{Session('invoice_mail_success')}}
                    </div>

                    @endif
                    
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Billing Number</th>
                                <th scope="col" class="text-center">Moon</th>
                                <th scope="col" class="text-center">Date of issue</th>
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
                            @foreach($invoice as $invoice)
                            <tr>
                                <?php
                                $issue_date = \Carbon\Carbon::parse($invoice->issue_date)->format('d-m-Y');
                                $due_date = \Carbon\Carbon::parse($invoice->due_date)->format('d-m-Y');
                                ?>
                                <td class="text-center">{{$i}}</td>
                                <td class="text-center">{{$invoice->invoice_id}}</td>
                                <td class="text-center">{{$invoice->month}}-{{$invoice->year}}</td>
                                <td class="text-center">{{$invoice->issue_date}}</td>
                                <td class="text-center">{{$invoice->due_date}}</td>
                                <td class="text-center">{{$invoice->dm_total_number}}</td>
                                @if($invoice->billing_status == 1)
                                <td style="color: green;font-weight:bold;" class="text-center">Deposited</td>
                                @elseif($invoice->billing_status == 0)
                                <td style="color: red;font-weight:bold;" class="text-center">Not Payment</td>
                                @endif
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Payment
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{URL::to('send-invoice-mail/'.$invoice->invoice_id)}}" onclick="return send_invoice_details();">Send e-mail</a>
                                            @if($invoice->billing_status == 0)
                                            <a class="dropdown-item"
                                               href="{{URL::to('payment-receive/'.Crypt::encrypt($invoice->invoice_id))}}" onclick="return payment_received();">Deposited</a>
                                            @endif
                                            <a class="dropdown-item"
                                               href="{{URL::to('create-invoice/'.Crypt::encrypt($invoice->user_id).'/'.Crypt::encrypt($invoice->invoice_id))}}"
                                               target="_blank">Print Invoice</a>
                                            <!-- <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated </a>
                                          </div> -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <form action="{{URL::to('update-user-extra-information')}}" method="post">
      {{csrf_field()}}
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Invoice Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name" required="">
                  </div>
                  <div class="form-group">
                    <input type="text" name="company_name" class="form-control" placeholder="Department in Charge" required="">
                  </div>
                    <div class="form-group">
                        <input type="text" name="contact_number" class="form-control" placeholder="Phone Number" required="">
                    </div>
                    <div class="form-group">
                        <input type="text" name="street" class="form-control" placeholder="Street Address" required="">
                    </div>
                    <div class="form-group">
                        <input type="text" name="postal_code" class="form-control" placeholder="Postal Code" required="">
                    </div>
                    <input type="hidden" name="info_id" class="form-control" value="@if(isset($user_info)){{$user_info->id}}@endif">
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </div>
          </div>
        </div> 
  </form>

        <!--        <div class="envelope_area">-->
        <!--            <div class="envelope">-->
        <!--                <a href="#">-->
        <!--                    <img src="{{asset('assets/img/message64.png')}}" alt="">-->
        <!--                </a>-->
        <!--            </div>-->
        <!--        </div>-->
    </div>
    @endsection