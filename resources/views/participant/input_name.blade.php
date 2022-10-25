@extends("layout.common",["title"=>"お名前登録"])
@section("content")
    <div class="text_center meeting_create">
        <img src="{{ asset('/assets/images/paticipant_status/input_name.png') }}" alt="ステータスバー" width="100%">
        <div class="font_size_20 mb_10">{{ $participant->meeting->name }}</div>
    	
        <div class="error_text font_size_12">
            @if($request->dup_name == 1)
                <div>参加者名が他の参加者名と重複しています。</div>
            @elseif($request->no_name == 1)
                <div>参加者名が不正です。</div>
            @endif
    	</div>
        
        <form action="./input_name_store" method="post" class="admin_form">
            @csrf
            <label class="form_label">お名前</label><br/>
            <input type="text" name="name" class="input_text" maxlength="50"><br/>
            <div class="font_size_12">
	    		個人情報保護のため、ニックネームでの登録をお願いします。
	    	</div>
            <input type="submit" id="submit_btn" class="main_button" value="登録">
        </form>
        
        <a href="{{ route('participant.index', $participant->meeting->id) }}" class="min_button">待機所に戻る</a>
    </div>
@endsection