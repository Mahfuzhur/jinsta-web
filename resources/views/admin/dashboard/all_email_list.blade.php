@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

              <div class="progress_view">
                <h4 class="progress_margin"> <span><img src="{{asset('assets/img/iconshade222.png')}}" alt=""></span>Mail List (<span id="edit-count-checked-checkboxes"></span>{{$total}})</h4>   
                @if(session('delete_success'))
                <div class="alert alert-success">
                  {{ session('delete_success') }}
                    <p>{{ session('delete_success') }} &#10004; </p>
                </div> 
                @endif 
                @if(session('mail_err_msg'))
                <div class="alert alert-danger">
                    <p>{{ session('mail_err_msg') }} &#10004; </p>
                </div> 
                @endif
                @if(session('mail_success'))
                <div class="alert alert-success">
                    <p>{{ session('mail_success') }} &#10004; </p>
                </div> 
                @endif
                <form action="{{URL::to('admin-email-compose')}}" method="post" id="devel-generate-content-form">
                      {{csrf_field()}}
                <div style="margin-bottom: 15px;">
<!--                  <input type="checkbox" name="email"> <span style="font-weight: bold;">Select All</span>-->
                    <input type='checkbox' name='showhide' onchange="checkAll(this)" style="width: 20px;height: 20px;margin-left: 10px;"><span style="font-weight: bold;font-size: 20px;padding-left: 5px;">すべて選択</span>

<!--                <div style="margin-bottom: 15px;margin-left: 10px;">-->
<!--                  <input type="checkbox" name="email"> <span style="font-weight: bold;">Select All</span>-->
                    <button type="submit" class="btn btn-success btn-md pull-right" style="background: #06af94; float:right">メール作成</button>
                </div>
                  <div class="table-wrapper-scroll-y my-custom-scrollbar">
                  <table class="table table-hover table-bordered">
                    <thead>
                      <tr>
                        <th scope="col" class="text-center">マーク</th>
                        <th scope="col" class="text-center">会社名</th>
                        <th scope="col" class="text-center">担当者名</th>
                        <th scope="col" class="text-center">メールアドレス</th>
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
                          <td class="text-center"><input type='checkbox' name='email[]' value="{{$user_email->email}}" id='check_{{$counter}}' style="width: 15px;height: 15px;"></td>
                          <td class="text-center">{{$user_email->company_name}}</td>
                          <td class="text-center">{{$user_email->name}}</td>
                          <td class="text-center">{{$user_email->email}}</td>
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
            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">

                </ul>
              </nav> 

              <div>
                
              </div>
            </form>
        </div>
        
<!--        <div class="envelope_area">-->
<!--           <div class="envelope">-->
<!--              <a href="#">-->
<!--                <img src="{{asset('assets/img/message64.png')}}" alt="">-->
<!--              </a>-->
<!--           </div>-->
<!--        </div>           -->
  </div>
    <script type='text/javascript'>

        // Set check or unchecked all checkboxes
        function checkAll(e) {
            var checkboxes = document.getElementsByName('email[]');
            var total_check = checkboxes.length;
            if (e.checked) {
              document.getElementById("edit-count-checked-checkboxes").innerHTML = total_check+'/';
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = true;
                }
            } else {
              document.getElementById("edit-count-checked-checkboxes").innerHTML = '';
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