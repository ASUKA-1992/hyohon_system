@extends("layout.admin.common",["title"=>"役割新規作成"])
@section("content")
    <div class="text_center">
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="./store" method="post" class="admin_form">
            @csrf
            <label>役割名</label>
            <input type="text" name="name" class="input_text w_250 mb_10" maxlength="20"><br/>
            <label>区分名</label>
            <select name="name_sub" class="w_250">
                @foreach (config("const.roles.name_sub") as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select><br/>
            <input type="submit" value="登録">
        </form>
    </div>
@endsection