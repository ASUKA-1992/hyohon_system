@extends("layout.admin.common",["title"=>"テーマ新規作成"])
@section("content")
    <div class="text_center">
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="./store" method="post" class="admin_form">
            @csrf
            <label>テーマ名</label>
            <input type="text" name="name" class="input_text w_250 mb_10" maxlength="20"><br/>
            <label>備考</label>
            <input type="text" name="note" class="input_text w_250 mb_10" maxlength="20"><br/>
            <input type="submit" value="登録">
        </form>
    </div>
@endsection