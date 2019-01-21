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
                          <a class="" href="{{URL::to('user-login')}}" title="Step 2">
                              <span class="round-tab">
                                  <p>#2</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled">
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
                  <h3>Thank you for your Registration</h3>
                  <p>lorem ipusm dolor shet emet ingio mean tele laumand</p>
                </div>
                <div class="button_holder">                      
                  <button type="submit" class="btn registration_btn">Submit</button>                  
                </div>
                
              </div>
          </div>
       </div>
    </div>
@endsection