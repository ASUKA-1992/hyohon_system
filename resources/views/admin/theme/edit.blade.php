@extends("layout.admin.common",["title"=>"テーマ新規作成"])
@section("content")
    <div class="text_center">
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="{{ route('theme.update', ['id'=>$theme->id]) }}" method="post" class="admin_form">
            @csrf
            @method('patch')
            <label>役割名</label>
            <input type="text" name="name" class="input_text w_250 mb_10" maxlength="20"
                value="{{old('name') ?? $theme->name}}"><br/>

            <label>備考</label>
            <input type="text" name="note" class="input_text w_250 mb_10" maxlength="20"
                value="{{old('note') ?? $theme->note}}"><br/>

            <input type="radio" name="active_flg" value="1" <?php if($theme->active_flg=="1"){print "checked";}?>>
            <label>有効</label>
            <input type="radio" name="active_flg" value="0" <?php if($theme->active_flg=="0"){print "checked";}?>>
            <label>無効</label><br/>
            
            <input type="submit" value="登録">
        </form>
    </div>
@endsection