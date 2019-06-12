<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$invoice_info->month.'-'.$invoice_info->year}}.pdf</title>
    <style>

    body{
        font-family: ipag;
    }

    hr {
    border: none;
    height: 1px;
    /* Set the hr color */
    color: #333; /* old IE */
    background-color: #1b17176b; /* Modern Browsers */
}

        /*@font-face {
            font-family: 'Japanese';
            font-style: normal;
            font-weight: normal;
            src: url('public/assets/Japanese.ttf') format('truetype');
        }*/
    </style>
</head>
<body>

<div>
    <h1 style="text-align: center;">御請求書</h1>
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
    <td align="left" style="width: 40%;font-size: 15px;">
        
        <p>
            @if(isset($customer_info))
            <span>{{ $customer_info->name }}</span><br>
            <span>{{ $customer_info->contact_number }}</span><br>
            <span>{{ $customer_info->street }}</span><br>
            <span>{{ $customer_info->postal_code }}</span>
            @endif
        </p>
        
<!--        <p>Client Name:</p>-->
<!--        <p>Phone Number:</p>-->
<!--        <p>Client Address:</p>-->
    </td>
    <td style="width: 30%;"></td>
    <td align="left" style="width: 30%;font-size: 15px;">
        <!--            <img src="{{asset('assets/img/logo.png')}}">-->
        <p>
            <span><img src="{{asset('assets/img/pdf_logo.PNG')}}" alt="" style="width: 150px;height: 50px;"></span><br>
            <span>株式会社TagLetter</span><br>
            <span>〒171-0021</span><br>
            <span>東京都豊島区西池袋 1-11-1</span><br>
            <span>メトロポリタンプラザビル14階</span><br>
            <span>TEL: 03-6273-845</span><br>
            <span>FAX: 03-6273-8450</span><br>
            <?php
            $issue_date = \Carbon\Carbon::parse($invoice_info->issue_date)->format('d-m-Y');
            $due_date = \Carbon\Carbon::parse($invoice_info->due_date)->format('d-m-Y');
            ?>
            <span>請求書番号: #{{ $invoice_info->invoice_id }}</span><br>
            <span>請 求 日: {{ $issue_date }}</span><br>
            <span>お支払期限: {{ $due_date }}</span>
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
    <h2>ご請求金額 :  {{ ($setting_info->message_rate * $invoice_info->dm_total_number) - 0}} 円</h2>
</div>

<!--<span style="border-left: 2px solid red;"></span>-->

<table style="width: 100%">
    <tr style="line-height: 10px;">
        <th align="left" style="width: 40%;">詳細</th>
        <th style="width: 20%;text-align: center;">単価</th>
        <th style="width: 20%;text-align: center;">数量</th>
        <th style="width: 20%;text-align: center;">価格</th>
    </tr>
    <tr style="line-height: 10px;">
        <td colspan="4"><hr></td>
    </tr>
    
    <tr style="line-height: 1px;">
        <td align="left" style="width: 40%;font-size: 18px;">
            <p>@if(isset($customer_info)){{ $customer_info->name }}@endif</p>
        </td>
        <td style="width: 20%;text-align: center;">
            <p>{{ $setting_info->message_rate }}</p>
        </td>
        <td style="width: 20%;text-align: center;">
            <p>{{ $invoice_info->dm_total_number }}</p>
        </td>
        <td style="width: 20%;text-align: center;">
            <p>{{ $setting_info->message_rate * $invoice_info->dm_total_number}}</p>
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

    <tr style="line-height: 10px;">
        <td align="left" style="width: 40%;font-size: 15px;">

        </td>
        <td colspan="3" style="width: 60%;">
            <p>           
                <span style="margin-left: 50px;">小計</span><span style="margin-left: 250px;">{{ $setting_info->message_rate * $invoice_info->dm_total_number}} 円</span><br><hr>
                <span style="margin-left: 50px;">消費税</span><span style="margin-left: 250px;">0 円</span><br><hr>
                <span style="margin-left: 50px;">合計</span><span style="margin-left: 250px;">{{ ($setting_info->message_rate * $invoice_info->dm_total_number) - 0}} 円</span><br><hr>
            </p>
        </td>
        <!-- <td style="width: 20%;">
            <p>
            
                <span>小計</span><br><hr>
                <span>消費税</span><br><hr>
                <span>合計</span><hr>
            </p> -->
<!--            <p>Subtotal</p>-->
<!--            <p>Consumtion Tax</p>-->
<!--            <p>Total</p>-->
        <!-- </td>
        <td style="width: 20%;">

        </td>
        <td style="width: 20%;">
            <p>
            
                <span>{{ $setting_info->message_rate * $invoice_info->dm_total_number}} 円</span><br><hr>
                <span>0 円</span><br><hr>
                <span>{{ ($setting_info->message_rate * $invoice_info->dm_total_number) - 0}} 円</span><hr>
            </p> -->
<!--            <p>1000</p>-->
<!--            <p>200</p>-->
<!--            <p>2000</p>-->
        <!-- </td> -->
    </tr>
</table>

<span style="font-size: 20px;font-weight: bold;">振込先</span><br>
<div style="width: 720px;height: auto;border: 1px solid #7777869c;">
    <div style="margin-left: 25px;padding: 10px;">
        <span style="font-size: 18px;font-weight: bold;">【横浜銀行】</span><br>
        <span>関内支店（310）普通 6047465 ｶ) ﾈｸｽﾄｽﾃｰｼﾞ</span><br><br>
        <span style="font-size: 18px;font-weight: bold;">【みずほ銀行】</span><br>
        <span>渋谷支店（210）普通 1742329 ｶ) ﾈｸｽﾄｽﾃｰｼﾞ</span><br><br>
        <span style="font-size: 18px;font-weight: bold;">【城南信用金庫】</span><br>
        <span>渋谷支店（025）普通 439196 ｶ) ﾈｸｽﾄｽﾃｰｼﾞ</span>
    </div>
</div>
<br>
<span style="font-size: 20px;font-weight: bold;">備考</span><br>
<div style="width: 720px;height: 50px;border: 1px solid #7777869c;">

</div>


</body>
</html>
