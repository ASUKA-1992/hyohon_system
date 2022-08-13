@extends("layout.common",["title"=>"会議作成"])
@section("content")
    <div class="text_center meeting_create">
        @if (count($errors) > 0)
            <div class="error_text">
                @foreach ($errors->all() as $error )
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form action="" method="post" class="admin_form">
            @csrf
            <label class="form_label">{{ config("const.label.comment") }}</label><br/>
            <textarea name="comment">{{ $meeting->comment }}</textarea><br/>

            <input type="submit" id="submit_btn" class="main_button" value="登録">
        </form>
    </div>
@endsection