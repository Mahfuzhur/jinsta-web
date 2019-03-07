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
                          <a class="active" href="{{URL::to('user-registration')}}" title="Step 1">
                              <span class="round-tab">
                                  <p>#1</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled step_2">
                          <a href="{{URL::to('instagram-info')}}" title="Step 2">
                              <span class="round-tab">
                                  <p>#2</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled step_3">
                          <a href="{{URL::to('registration-success')}}" title="Complete">
                              <span class="round-tab">
                                  <p>#3</p>
                              </span>
                          </a>
                      </li>
                  </ul>
              </div>

              <div class="sign_up_form">
                <div class="form_title">
                  <h3>sign up</h3>
                </div>
                <form role="form" method="POST" action="{{ route('register') }}">
                  {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                      <label for="companyname"> 企業名</label>
                      <input type="text" class="form-control" name="company_name" id="company_name" placeholder="株式会社NextStage" value="{{ old('company_name') }}" required="">

                      @if ($errors->has('company_name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('company_name') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="contactname">担当者名</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="山田　太郎" value="{{ old('name') }}" required="">
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                      <label for="mobile">電話番号</label>
                      <input type="number" class="form-control" name="mobile" id="mobile" placeholder="0362738450(ハイフンなし)" value="{{ old('mobile') }}" required="">
                      @if ($errors->has('mobile'))
                          <span class="help-block">
                              <strong>{{ $errors->first('mobile') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">メールアドレス</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="{{ old('email') }}" required="">
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>既に登録されたメールアドレスです。別のメールアドレスをご入力ください。</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password">パスワード</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="sample1234（6文字以上）" required="">
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">パスワード再入力</label>
                      <input type="password" class="form-control" name="password_confirmation" id="group" placeholder="sample1234（6文字以上）" required="">
                    </div>
                    
                    <!-- <div class="form-group">
                      <div>
                        <p><a href="#">Click here</a> if you have an introduction code</p>
                      </div>
                    </div> -->

                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1" required="">
                      <label class="form-check-label" for="exampleCheck1">&nbsp;&nbsp;私はプライバシーポリシーに同意します</label>
                      <!--<label class="form-check-label" for="exampleCheck1">I agrre to <a href="#">terms of service</a> and <a href="#">Privacy policy</a></label>-->
                    </div>

                    <div class="button_holder">                      
                      <button type="submit" class="btn registration_btn">Next</button>
                      <div class="form-group">                      
                        <a href="#">お問い合わせはコチラ</a>
                      </div>
                    </div>
                    
                </form>
              </div>
          </div>
       </div>
    </div>
@endsection