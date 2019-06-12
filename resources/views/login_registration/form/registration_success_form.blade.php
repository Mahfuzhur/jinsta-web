@extend('login_registration.master')
@section('content')
<div class="container u_main_content">
      <div class="row">
          <div class="page_heading">
              <h2 class="">3STEPで簡単サインイン</h2>
          </div>
          <div class="wizard">
              <div class="wizard-inner">
                  <ul class="nav nav-tabs" role="tablist">

                      <li role="presentation" class="step_1">
                          <a class="" href="{{URL::to('user-registration')}}" title="Step 1">
                              <span class="round-tab">
                                  <p>#1</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled step_2">
                          <a class="" href="{{URL::to('instagram-info')}}" title="Step 2">
                              <span class="round-tab">
                                  <p>#2</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled step_3">
                          <a class="active" href="{{URL::to('registration-success')}}" title="Complete">
                              <span class="round-tab">
                                  <p>#3</p>
                              </span>
                          </a>
                      </li>
                  </ul>
              </div>

              <div class="sign_in_form">
                <div class="form_title">
                  <h3>ご登録ありがとうございます。</h3>
                  ご利用には［メール認証］が必要となります。<br>
                  ご登録頂きましたアドレス宛に認証用メールをお送りしております。<br>
                  ご確認お願い致します。
                  <!-- <p style="color: green;">A verification link has been sent to your email.</p> -->
                </div>
                <a href="{{URL::to('/')}}">
                  <div class="button_holder">                                     
                    <button type="button" class="btn registration_btn" style="padding: 6px 15px;">ホーム</button>
                  </div>
                </a>
                
              </div>
          </div>
       </div>
    </div>
@endsection