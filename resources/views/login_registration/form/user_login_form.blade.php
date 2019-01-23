@extend('login_registration.master')
@section('content')
    <div class="container">
      <div class="row">
          <div class="wizard">
              <div class="wizard-inner">
                  <div class="connecting-line"></div>
                  <ul class="nav nav-tabs" role="tablist">

                      <li role="presentation">
                          <a class="" href="{{URL::to('user-registration')}}" title="Step 1">
                              <span class="round-tab">
                                  <p>#1</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled">
                          <a class="active" href="{{URL::to('user-login')}}" title="Step 2">
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

              <div class="sign_in_form">
                <div class="form_title">
                  <h3>sign in</h3>
                </div>
                <form role="form" method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="example@email.com" required="">
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

                    <div class="button_holder">                      
                      <button type="submit" class="btn registration_btn">Sign in</button>
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
