@extends("layout.admin.common",["title"=>"役割新規作成"])
@section("content")
    <div class="admin_form_div text_center">
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="{{ route('role.update', ['id'=>$role->id]) }}" method="post" class="admin_form">
            @csrf
            @method('patch')
            <label class="form_label">役割名</label><br/>
            <input type="text" name="name" class="input_text w_250 mb_10" maxlength="20"
                value="{{old('name') ?? $role->name}}"><br/>

                <label class="form_label">区分名</label><br/>
            <select name="name_sub" class="w_250">
                @foreach (config("const.roles.name_sub") as $key => $value)
                    @if($role->name_sub == $key)
                        <option value="{{ $key }}" selected="selected">{{ $value }}</option>
                    @else
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endif
                @endforeach
            </select>

            <div>
                <span class="form_label">有効</span>
                <input type="radio" name="active_flg" value="1" <?php if($role->active_flg=="1"){print "checked";}?>>
            </div>
            <div>
                <span class="form_label">無効</span>
                <input type="radio" name="active_flg" value="0" <?php if($role->active_flg=="0"){print "checked";}?>>
            </div>
            
            <input type="submit" class="main_button" value="登録">
        </form>
    </div>
@endsection