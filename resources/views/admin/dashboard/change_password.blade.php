@extend('master')
@section('user_main_content')
<div id="page-content-wrapper" class="analytics">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <form action="{{URL::to('update-password')}}" method="post">
                    {{csrf_field()}}
                    <div class="progress_view">
                        <h4 class="progress_margin">
                            <i class="fa fa-key" aria-hidden="true"></i> パスワードを変更する
                        </h4>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(session('update_msg'))
                        <div class="alert alert-success">
                            <p>{{ session('update_msg') }} &#10004; </p>
                        </div>
                        @endif
                        @if(session('ex_msg'))
                        <div class="alert alert-danger">
                            <p>{{ session('ex_msg') }}</p>
                        </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-2 col-form-label">以前のパスワード</label>
                            <div class="col-4">
                                <input type="password" class="form-control" name="old_password"
                                       value="" placeholder="古いパスワードを入力してください">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">新しいパスワード</label>
                            <div class="col-4">
                                <input type="password" class="form-control" name="password"
                                       value=""
                                       placeholder="新しいパスワードを入力してください">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">新しいパスワードを確認</label>
                            <div class="col-4">
                                <input type="password" class="form-control" name="password_confirmation"
                                       value=""
                                       placeholder="新しいパスワードの確認を入力してください">
                            </div>
                        </div>
                       <div style="margin-left: 41%">
                            <button onclick="return confirm('本当にパスワードを更新しますか？');" type="submit"
                                    class="btn btn-success"
                                    data-original-title="Update Password" data-toggle="tooltip"
                                    data-placement="top" title="">更新
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection