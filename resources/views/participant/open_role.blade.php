@extends('layout.common_paticipant',['title'=>'会議閲覧','participant'=>$participant])
@section('content')
<div class="text_center meeting_create">
    <p class="litte_bold_text">{{ $participant->name }}さんの役割は……</p>
    
    @if($participant->role_open == 0)
	    <div>
	        <button id="show_text_button" class="card_btn" onclick="open_text('{{ $participant->role_name }}')">
                <img src="{{ asset('/assets/images/card/card_role_ura.png') }}" alt="あなたの役割を見る!" />
            </button>
            <div id="catd_omote" class="card_omote disp_none">
                <p id="main_text" class="font_size_20 text_card_omote"></p>
                <img src="{{ asset('/assets/images/card/card_role_omote.png') }}" alt="{{ $participant->role_name }}" />
            </div>
	    </div>
	@else
        <div id="catd_omote" class="card_omote">
            <p class="font_size_20 text_card_omote"><span>{{ $participant->role_name }}</span></p>
            <img src="{{ asset('/assets/images/card/card_role_omote.png') }}" alt="{{ $participant->role_name }}" />
        </div>
	@endif
</div>

<script>
    //1文字ずつ文字列表示
    function open_text(arg_text){
        $.ajax({
            type: "get",
            url: "{{ $participant->id }}/role_open",
            dataType: "json",
        })
        .done((res) => {
            //ボタンの置き換え
            $('#show_text_button').hide();
            $('#catd_omote').show();

            //textのid要素を取得、のち<span>～に書き換える
            let spanText  = document.getElementById('main_text');
            //要素の中身を取得、文字を区切るため
            let newText ="";
            let i = 0;
            arg_text.split("").forEach(function(value) {
                newText += '<span class="main_text_span" style ="animation:showtext 3s ease ' + [i]*0.2 + 's forwards;">' + value + '</span>';
                i++;
            });
            spanText.innerHTML = newText;  
        })
        .fail((error) => {
            console.log(error.statusText);
        });
    }
</script>
@endsection