@extend('login_registration.master')
@section('content')
<div class="container">
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
                  <h3>登録が完了しました！</h3>
                  <!-- <p>完了まで数分程度かかることがあります。しばらくお待ちください。</p> -->
                </div>
                <a href="{{URL::to('dashboard')}}">
                  <div class="button_holder">                                     
                    <button type="submit" class="btn registration_btn">今すぐ始める！</button>
                      <div class="form-group">
                          <a href="#">お問い合わせはコチラ</a>
                      </div>
                  </div>
                </a>
                
              </div>
          </div>
       </div>
    </div>
@endsection