@extend('master')
@section('user_main_content')
<div id="page-content-wrapper">        

  <div class="container-fluid">
    <div class="row row-eq-height">
      <div class="col-md-6 col-sm-12">
          <div class="test_section">
            <!-- @if(!isset($json_selfinfo['message'])) -->
             <center><img class="test_img" src="{{asset('assets/img/user.png')}}"></center>
              <div class="test"><center>User image</center></div>
            <!-- @else -->
            <!-- <div class="test"><center style="color: #c32727;font-size: 20px;text-align: justify !important; padding: 20px;">*このメッセージは、テンプレートを送信できないことを示しています。

              2要素認証をオフにして、[設定]の[プライバシーとセキュリティ]オプションで自分のプロファイルを公開してください。

              ここであなたのInstagramの資格情報を更新する <a href="{{URL::to('update-instagram-info')}}" style="color: #06af94;">Update</a></center></div> -->
           <!--  @endif -->

          </div>
      </div>
      
    </div>
<!--    <div class="envelope_area">-->
<!--       <div class="envelope">-->
<!--          <a href="#">-->
<!--            <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--          </a>-->
<!--       </div>-->
<!--    </div>-->
  </div>
</div>
@endsection


  