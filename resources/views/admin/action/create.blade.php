@extends("layout.admin.common",["title"=>"アクション新規作成"])
@section("content")
    <div class="admin_form_div text_center">
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="./store" method="post" class="admin_form">
            @csrf
            <label class="form_label">アクション名</label><br/>
            <input type="text" name="name" class="input_text w_250 mb_10" maxlength="20"><br/>
            <label class="form_label">区分名</label><br/>
            <select name="name_sub" class="w_250">
                @foreach (config("const.actions.name_sub") as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select><br/>
            <input type="submit" class="main_button" value="登録">
        </form>
    </div>
@endsection