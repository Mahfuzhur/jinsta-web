<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>invoice</title>
    <style>


        @font-face {
            font-family: 'wackysushi';
            font-style: normal;
            font-weight: normal;
            src: url(https://www.backslashkey.com/jinsta-test/fonts/wackysushi.ttf) format('truetype');
        }
    </style>
</head>
<body>

<div>
    <h1 style="text-align: center">御請求書</h1>
</div>


<!--    <div style="width: 40%;">-->
<!--        <p style="font-size:20px;font-weight: bold;">Client Name:</p>-->
<!--        <p style="font-size:20px;font-weight: bold;">Phone Number:</p>-->
<!--        <p style="font-size:20px;font-weight: bold;">Client Address:</p>-->
<!--    </div>-->
<!--    <div style="width: 40%;align: right;">-->
<!---->
<!--        <p style="font-size:20px;font-weight: bold;">Company Name:</p>-->
<!--        <p style="font-size:20px;font-weight: bold;">Company Address:</p>-->
<!--        <p style="font-size:20px;font-weight: bold;">Telephone:</p>-->
<!--    </div>-->
<table style="width: 100%">
    <td align="left" style="width: 40%;font-size: 18px;">
        <p>
            <span>{{ $customer_info->name }}</span><br>
            <span>{{ $customer_info->mobile }}</span><br>
            <span>Tokyo, Japan</span>
        </p>
<!--        <p>Client Name:</p>-->
<!--        <p>Phone Number:</p>-->
<!--        <p>Client Address:</p>-->
    </td>
    <td style="width: 20%;"></td>
    <td align="left" style="width: 40%;font-size: 18px;">
        <!--            <img src="{{asset('assets/img/logo.png')}}">-->
        <p>
            <span>dosnix technology</span><br>
            <span>Banosree, Main road;Dhaka</span><br>
            <span>0123456789</span><br>
            <span>Fax:1234569857</span><br>
            <span>Invoice Number:#326548214</span><br>
            <span>Billing Date:01/05/2019</span><br>
            <span>Payment Deadline:07/05/2019</span>
        </p>
<!--        <p>Company Name:</p>-->
<!--        <p>Company Address:</p>-->
<!--        <p>Telephone:</p>-->
<!--        <p>Fax:</p>-->
<!--        <p>Invoice Number:</p>-->
<!--        <p>Billing Date:</p>-->
<!--        <p>Payment Deadline:</p>-->
    </td>
</table>

<div>
    <h2>Amount Billed: 27,700</h2>
</div>
<hr>
<!--<span style="border-left: 2px solid red;"></span>-->

<table style="width: 100%">
    <tr>
        <th align="left" style="width: 40%;">Detail</th>
        <th style="width: 20%;text-align: center;">Unit Prize</th>
        <th style="width: 20%;text-align: center;">Quantity</th>
        <th style="width: 20%;text-align: center;">Prize</th>
    </tr>
    <tr>
        <td colspan="4"><hr></td>
    </tr>
    <tr>
        <td align="left" style="width: 40%;font-size: 18px;">
            <p>{{ $customer_info->name }}</p>
        </td>
        <td style="width: 20%;text-align: center;">
            <p>2500</p>
        </td>
        <td style="width: 20%;text-align: center;">
            <p>5</p>
        </td>
        <td style="width: 20%;text-align: center;">
            <p>7500</p>
        </td>
    </tr>

<!--    <tr>-->
<!--        <td align="left" style="width: 40%;font-size: 18px;">-->
<!---->
<!--        </td>-->
<!--        <td colspan="3" style="width: 60%;">-->
<!--            <hr>-->
<!--        </td>-->
<!--<!--        <td style="width: 20%;">-->-->
<!--<!--            <p>Client Name</p>-->-->
<!--<!--        </td>-->-->
<!--<!--        <td style="width: 20%;">-->-->
<!--<!--            <p>Client Name</p>-->-->
<!--<!--        </td>-->-->
<!--    </tr>-->

    <tr>
        <td align="left" style="width: 40%;font-size: 18px;">

        </td>
        <td style="width: 20%;text-align: center;">
            <p>
            <hr>
                <span>Subtotal</span><br><hr>
                <span>Consumtion Tax</span><br><hr>
                <span>Total</span>
            </p>
<!--            <p>Subtotal</p>-->
<!--            <p>Consumtion Tax</p>-->
<!--            <p>Total</p>-->
        </td>
        <td style="width: 20%;">

        </td>
        <td style="width: 20%;text-align: center;">
            <p>
            <hr>
                <span>1000</span><br><hr>
                <span>100</span><br><hr>
                <span>2000</span>
            </p>
<!--            <p>1000</p>-->
<!--            <p>200</p>-->
<!--            <p>2000</p>-->
        </td>
    </tr>
</table>

<span style="font-size: 20px;font-weight: bold;">Payee</span><br><br>
<div style="width: 720px;height: auto;border: 1px solid #7777869c;">
    <div style="margin-left: 25px;padding: 10px;">
        <span style="font-size: 20px;font-weight: bold;">Yokohama Bank</span><br>
        Kannai branch (310) usually 6047465) Next stage<br><br>
        <span style="font-size: 20px;font-weight: bold;">Mizuho Bank</span><br>
        Shibuya branch (210) Normal 1742329) Next stage<br><br>
        <span style="font-size: 20px;font-weight: bold;">Shonan Shinkin Bank</span><br>
        Shibuya branch (025) usually 439,196 months) next stage
    </div>
</div>
<br>
<span style="font-size: 20px;font-weight: bold;">Remarks</span><br><br>
<div style="width: 720px;height: 80px;border: 1px solid #7777869c;">

</div>


<!--<tr>-->
<!--    <td align="left" style="width: 50%;">-->
<!--            <pre>-->
<!--                Client Name:-->
<!--                Phone Number:-->
<!--                Client Address:-->
<!--            </pre>-->
<!--    </td>-->
<!--    <td style="width: 50%;">-->
<!--            <pre>-->
<!--                Company Name:-->
<!--                Company Address:-->
<!--                Telephone:-->
<!--                Fax:-->
<!--                Invoice Number:-->
<!--                Billing Date:-->
<!--                Payment Deadline:-->
<!--            </pre>-->
<!--    </td>-->
<!--</tr>-->

<!--    <table>-->
<!--  <thead>-->
<!--    <tr>-->
<!--      <th>ID</th>-->
<!--      <th>Name</th>-->
<!--      <th>Email</th>-->
<!--      <th>Phone</th>-->
<!--    </tr>-->
<!--  </thead>-->
<!--  <tbody>-->
<!--    -->
<!--      <tr>-->
<!--        <td>{{ $customer_info->id }}</td>-->
<!--        <td>{{ $customer_info->name }}</td>-->
<!--        <td>{{ $customer_info->email }}</td>-->
<!--        <td>{{ $customer_info->mobile }}</td>-->
<!--      </tr>-->
<!--    -->
<!--  </tbody>-->
<!--</table>-->
</body>
</html>
