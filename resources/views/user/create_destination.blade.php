@extend('master)
@section('user_main_content')
<div id="page-content-wrapper" xmlns="http://www.w3.org/1999/html">
    <div class="container-fluid">
      <div class="row create_destination">            
        <div class="col-sm-12 main_content">
            <div class="box_title">
                <h4>宛先リスト名：テストテストテスト</h4>
            </div>

            <form method="post" action="{{URL::to('hashtag-search')}}">
                {{ csrf_field() }}
                <div class="hashtag_title left-border m-b-40">
                    <h4>#から作成</h4>
                    <div class="input_box">
                        <label for="hastag">
                            #から作成
                        </label>
                        <input type="text" name="hashtag" id="hashtag" class="hashtag_input ">
                        <button type="submit">search</button>
                    </div>
                </div>
            </form>
            @if(isset($results))
            @foreach($results as $result)
            {{$result->name}}
             **
            {{$result->search_result_subtitle}} = <a href="hashtag-selected/{{$result->name}}">select</a>
            <br>
            @endforeach
            @endif
            <div class="csv_upload left-border m-b-40">
                <h4 class="">ファイルアップロード</h4>
                <div class="input_box">
                  <label for="file">                          
                      <strong>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
                        </svg>
                      </strong>
                      <span></span> 
                  </label>
                  <input type="file" name="file[]" id="file" class="inputfile csv_input" data-multiple-caption="{count} files selected" multiple="">                      
                </div>
            </div>

            <div class="id_title left-border m-b-40">
                <h4>個別入力</h4>
                <div class="input_box">
                    <label for="id">
                        <img src="{{asset('assets/img/pen.svg')}}" alt="">
                    </label>
                    <input type="text" name="id" id="id" class="id_input ">                   
                </div>
            </div>

            <div class="form_buttons">
                <button class="btn_cancel p_btn">削除する</button>
                <button class="btn_done p_btn">登録する</button>
            </div>
        </div>


        <div class="envelope_area">
           <div class="envelope">
              <i class="fa fa-envelope" aria-hidden="true"></i>
           </div>
        </div>

    </div>
 </div>
 @endsection