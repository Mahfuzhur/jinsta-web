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
                <form role="form">
                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" placeholder="example@email.com">
                    </div>
                    <div class="form-group">
                      <label for="password">Enter Password</label>
                      <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="confirm_password">Confirm Password</label>
                      <input type="password" class="form-control" id="group" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                      <label for="companyname">Company Name</label>
                      <input type="text" class="form-control" id="cname" placeholder="Company Name">
                    </div>
                    <div class="form-group">
                      <label for="contactname">Contact Name</label>
                      <input type="text" class="form-control" id="cname" placeholder="Contact Name">
                    </div>
                    <div class="form-group">
                      <label for="mobile">Mobile No</label>
                      <input type="number" class="form-control" id="mobile" placeholder="Mobile No">
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
                      <button type="submit" class="btn registration_btn">Next</button>
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