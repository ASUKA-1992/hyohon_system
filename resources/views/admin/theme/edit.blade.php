@extends("layout.admin.common",["title"=>"テーマ新規作成"])
@section("content")
    <div class="admin_form_div text_center">
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="{{ route('theme.update', ['id'=>$theme->id]) }}" method="post" class="admin_form">
            @csrf
            @method('patch')
            <label class="form_label">役割名</label><br/>
            <input type="text" name="name" class="input_text w_250 mb_10" maxlength="50"
                value="{{old('name') ?? $theme->name}}"><br/>

            <label class="form_label">備考</label><br/>
            <input type="text" name="note" class="input_text w_250 mb_10"
                value="{{old('note') ?? $theme->note}}"><br/>

            <div>
                <span class="form_label">有効</span>
                <input type="radio" name="active_flg" value="1" <?php if($theme->active_flg=="1"){print "checked";}?>>
            </div>
            <span class="form_label">無効</span>
            <input type="radio" name="active_flg" value="0" <?php if($theme->active_flg=="0"){print "checked";}?>><br/>
            
            <input type="submit" class="main_button" value="登録">
        </form>
    </div>
@endsection