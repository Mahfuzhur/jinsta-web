@extend('admin.login_form.admin_master')
@section('content')
    <div class="container u_main_content">
      <div class="row">
          <div class="wizard">
              
              <div class="sign_in_form">
                <div class="form_title">
                  <h3>Login</h3>
                    @if(session('login_err'))
                    <div class="alert alert-danger">
                        {{ session('login_err') }}
                    </div>
                    @endif
                </div>
                <form role="form" method="POST" action="{{ URL::to('admin-login-check') }}">
                  {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Email</label>
                      <input type="name" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}"  required="">
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">
                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>

                    <div class="button_holder">                      
                      <button type="submit" class="btn registration_btn">Login</button>
                      <!-- <div class="form-group">                      
                        <a href="#">Help for regitering #Likes is here</a>
                      </div> -->
                    </div>
                    
                </form>
              </div>
          </div>
       </div>
    </div>
@endsection
