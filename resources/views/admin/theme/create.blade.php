@extends("layout.admin.common",["title"=>"テーマ新規作成"])
@section("content")
    <div class="admin_form_div text_center">
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="./store" method="post" class="admin_form">
            @csrf
            <label class="form_label">テーマ名</label><br/>
            <input type="text" name="name" class="input_text w_250 mb_10" maxlength="50"><br/>
            <label class="form_label">備考</label><br/>
            <input type="text" name="note" class="input_text w_250 mb_10"><br/>
            <input type="submit" class="main_button" value="登録">
        </form>
    </div>
@endsection