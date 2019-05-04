<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">名</th>
      <th scope="col">会社名</th>
      <th scope="col">メールアドレス</th>
      <th scope="col">電話番号</th>
      <th scope="col">ステータス</th>
      <th scope="col">管理</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(isset($_GET['page'])){
        $i = ($_GET['page']*10)-9;
      }else{
        $i = 1;
      }
      
    ?>
    @if(isset($all_company))
      @foreach($all_company as $company)
      <tr>
        <td>{{$i}}</td>
        <td>{{$company->name}}</td>
        <td>{{$company->company_name}}</td>
        <td>{{$company->email}}</td>
        <td>{{$company->mobile}}</td>
        @if($company->account_status == 2)
        <td style="color: red;">Suspended</td>
        @elseif($company->account_status == 3)
        <td style="color: green;">Active</td>
        @endif
        <td>

          <form action="URL::to('suspend-company-info')" method="post">
              {{csrf_field()}}
              <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
            <div class="btn-group">
              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                管理する
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{URL::to('edit-company-info/'.Crypt::encrypt($company->id))}}">編集</a>
                <a class="dropdown-item" href="{{URL::to('delete-company-info/'.$company->id)}}" onclick="return check_delete();">削除</a>
                @if($company->account_status == 2)
                <a class="dropdown-item" href="javascript:void(0);" title="Make Active" value="{{$company->id}}" onclick="suspend_user({{$company->id}},'active');">活動的</a>
                @elseif($company->account_status == 3)
                <a class="dropdown-item" href="javascript:void(0);" title="Make Suspend" value="{{$company->id}}" onclick="suspend_user({{$company->id}},'suspend');">サスペンド</a>
                @endif
                <!-- <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated </a>
              </div> -->
            </div>
          </form>
        
          <!-- <select class="btn btn-success btn-md">
            <option>Manage</option>
            <option><a href="{{URL::to('edit-company-info/'.$company->id)}}">Edit</a></option>
            <option><a href="#">Delete</a></option>
            <option><a href="#">Suspend</a></option>
            <option><a href="#">Extra</a></option>
          </select> -->
          <!-- <form action="URL::to('suspend-company-info')" method="post">
            {{csrf_field()}}
            
          <a href="{{URL::to('edit-company-info/'.$company->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
          <a href="{{URL::to('delete-company-info/'.$company->id)}}" title="Delete" onclick="return check_delete();"><i class="fa fa-trash"></i></a>
          
            <meta type="hidden" name="csrf-token" content="{{csrf_token()}}">
            @if($company->account_status == 2)
              <a href="javascript:void(0);" title="Make Active" value="{{$company->id}}" onclick="suspend_user({{$company->id}});"><i class="fa fa-user"></i></a>
            @elseif($company->account_status == 3)  
              <a href="javascript:void(0);" title="make Suspend" value="{{$company->id}}" onclick="suspend_user({{$company->id}});"><i class="fa fa-remove"></i></a>
            @endif  
          </form> -->                        
          
        </td>
      </tr>
      <?php
        $i++;
      ?>
      @endforeach
    @endif
  </tbody>
</table>