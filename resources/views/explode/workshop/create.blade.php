@extends("layout.explode.common",["title"=>"NEW"])
@section("content")
    <div class="admin_form_div text_center">
        <div class="">
            <a class="link_text" href="../explode">トップ画面へ</a>
            <div>■新規作成■</div>
        </div>
        @if (count($errors) > 0)
            <div class="error_text">
                @foreach ($errors->all() as $error )
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form action="./store" method="post" class="admin_form">
            @csrf
            <div class="text_left">
                <label class="form_label">会議名</label><br/>
                <input type="text" name="name" class="input_text w_250 mb_10" maxlength="10">
            </div>
            <input type="submit" class="main_button" value="登録">
        </form>
    </div>
@endsection