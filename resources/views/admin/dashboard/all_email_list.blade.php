@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

              <div class="progress_view">
                <h4 class="progress_margin"> <span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Mail List</h4>   
                @if(session('delete_success'))
                <div class="alert alert-success">
                  {{ session('delete_success') }}
                </div> 
                @endif 

                <div style="margin-bottom: 15px;">
<!--                  <input type="checkbox" name="email"> <span style="font-weight: bold;">Select All</span>-->
                    <input type='checkbox' name='showhide' onchange="checkAll(this)"><span style="font-weight: bold;">Select All</span>

<!--                <div style="margin-bottom: 15px;margin-left: 10px;">-->
<!--                  <input type="checkbox" name="email"> <span style="font-weight: bold;">Select All</span>-->

                </div>
                  <form action="{{URL::to('admin-email-compose')}}" method="post">
                      {{csrf_field()}}
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Mark</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $counter =0; ?>
                      <?php
                        if(isset($_GET['page'])){
                          $i = ($_GET['page']*10)-9;
                        }else{
                          $i = 1;
                        }
                        
                      ?>
                      @if(isset($all_user_email))
                        @foreach($all_user_email as $user_email)
                        <tr id='tr_{{$counter}}'>
                          <td><input type='checkbox' name='email[]' value="{{$user_email->email}}" id='check_{{$counter}}'></td>
                          <td>{{$user_email->company_name}}</td>
                          <td>{{$user_email->name}}</td>
                          <td>{{$user_email->email}}</td>
                        </tr>
                        <?php
                          $i++;
                          $counter++;
                        ?>
                        @endforeach
                      @endif
                    </tbody>
                  </table>
              </div>                    
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">

                </ul>
              </nav> 

              <div>
                <button type="submit" class="btn btn-success btn-sm">Compose Mail</button>
              </div>
            </form>
        </div>
        
        <div class="envelope_area">
           <div class="envelope">
              <a href="#">
                <img src="{{asset('assets/img/message64.png')}}" alt="">
              </a>
           </div>
        </div>           
  </div>
    <script type='text/javascript'>

        // Set check or unchecked all checkboxes
        function checkAll(e) {
            var checkboxes = document.getElementsByName('email[]');

            if (e.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = true;
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = false;
                }
            }
        }

        // Hide Checked rows
        function hideChecked(){
            var checkboxes = document.getElementsByName('email[]');

            for (var i = 0; i < checkboxes.length; i++) {
                var checkid = checkboxes[i].id;
                var split_id = checkid.split("_");
                var rowno = split_id[1];
                if(checkboxes[i].checked){
                    document.getElementById("tr_"+rowno).style.display="none";
                }
            }

        }

        // Reset layout
        function reset(){
            var checkboxes = document.getElementsByName('email[]');
            document.getElementsByName("showhide")[0].checked=false;

            for (var i = 0; i < checkboxes.length; i++) {
                var checkid = checkboxes[i].id;
                var split_id = checkid.split("_");
                var rowno = split_id[1];
                document.getElementById("tr_"+rowno).style.display="table-row";
                checkboxes[i].checked = false;
            }

        }
    </script>
@endsection