@extend('login_registration.master')
@section('content')
<div class="container">
      <div class="row">
          <div class="page_heading">
              <h2 class="">3ステップでかんたん <br> サインイン </h2>
          </div>
          <div class="wizard">
              <div class="wizard-inner">
                  <ul class="nav nav-tabs" role="tablist">

                      <li role="presentation" class="step_1">
                          <a class="" href="registration.html" title="Step 1">
                              <span class="round-tab">
                                  <p>#1</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled step_2">
                          <a class="" href="Sign_in.html" title="Step 2">
                              <span class="round-tab">
                                  <p>#2</p>
                              </span>
                          </a>
                      </li>

                      <li role="presentation" class="disabled step_3">
                          <a class="active" href="success.html" title="Complete">
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