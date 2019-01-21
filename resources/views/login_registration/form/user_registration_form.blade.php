@extend('login_registration.master')
@section('content')

    <div class="container">
      <div class="row">
          <div class="wizard">
              <div class="wizard-inner">
                  <div class="connecting-line"></div>
                  <ul class="nav nav-tabs" role="tablist">

                      <li role="presentation">
                          <a class="active" href="{{URL::to('user-registration')}}" title="Step 1">
                              <span class="round-tab">
                                  <p>#1</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled">
                          <a href="{{URL::to('user-login')}}" title="Step 2">
                              <span class="round-tab">
                                  <p>#2</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled">
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
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" value="{{ old('email') }}" required="">
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password">Enter Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">Confirm Password</label>
                      <input type="password" class="form-control" name="password_confirmation" id="group" placeholder="Confirm Password" required="">
                    </div>
                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                      <label for="companyname">Company Name</label>
                      <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" value="{{ old('company_name') }}" required="">
                      @if ($errors->has('company_name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('company_name') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="contactname">Contact Name</label>
                      <input type="text" class="form-control" name="name" id="name" placeholder="Contact Name" value="{{ old('name') }}" required="">
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                      <label for="mobile">Mobile No</label>
                      <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Mobile No" value="{{ old('mobile') }}" required="">
                      @if ($errors->has('mobile'))
                          <span class="help-block">
                              <strong>{{ $errors->first('mobile') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <div>
                        <p><a href="#">Click here</a> if you have an introduction code</p>
                      </div>
                    </div>

                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">I agrre to <a href="#">terms of service</a> and <a href="#">Privacy policy</a></label>
                    </div>

                    <div class="button_holder">                      
                      <button type="submit" class="btn registration_btn">Submit</button>
                      <div class="form-group">                      
                        <a href="#">Help for regitering #Likes is here</a>
                      </div>
                    </div>
                    
                </form>
              </div>
          </div>
       </div>
    </div>
@endsection