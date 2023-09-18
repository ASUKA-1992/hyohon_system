@extends('layout.common_paticipant',['title'=>'会議閲覧','participant'=>$participant])
@section('content')
<div class="text_center meeting_create">
	<div id="discription" class="font_size_12 mb_10">いずれかの意見を選択してください。</div>
    <div class="mb_10">
    	<button class="button_img_yes" onclick="click_answer('1', 'YES')">
            <img id="card_yes" class="button_img_border" src="{{ asset('/assets/images/card/card_yes.png') }}" alt="YES" />
        </button>
        <button class="button_img_no" onclick="click_answer('0', 'NO')">
            <img id="card_no" class="button_img_border" src="{{ asset('/assets/images/card/card_no.png') }}" alt="NO" />
        </button>
	</div>
	
	<div>
		<p>{{ $participant->name }}さんの意見:
			@if(is_null($participant->answer2))
				<span id="self_answer_col">-</span>
			@else
				<span id="self_answer_col">{{ config("const.participants.answer")[$participant->answer2] }}</span>
			@endif
		</p>
	</div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(isset($participant->answer2))
        @if($participant->answer2 == 1)
            $('#card_yes').removeClass('button_img_border');
            $('#card_yes').addClass('button_img_border_selected');
            //色
            $('#self_answer_col').addClass('font_yes');
        @else
            $('#card_no').removeClass('button_img_border');
            $('#card_no').addClass('button_img_border_selected');
            //色
            $('#self_answer_col').addClass('font_no');
        @endif
    @endif
});

function click_answer(answer, answer_text){
    //現在の回答取得
    var current_answer = $("#self_answer_col").html().trim();
    
    //現在の回答が選択された回答と同じ場合、処理を行わない
    if(current_answer == answer_text){
        console.log("log: same answer");
        return;
    }

    // 既に回答が入力されている場合、確認ポップアップ表示
    if(current_answer == 'YES' || current_answer == 'NO'){
        var result = confirm('既に回答済みです。回答を変更しますか?');
        if(result == false){
            return;
        } 
    } 

    $.ajax({
        type: "get",
        url: "{{ $participant->id }}/meeting2_select",
        data: {'answer':answer},
        dataType: "json",
    })
    .done((res) => {
        $("#self_answer_col").text(answer_text);
        if(answer_text == "YES"){
            //カード枠
            $('#card_no').removeClass('button_img_border_selected');
            $('#card_no').addClass('button_img_border');
            $('#card_yes').removeClass('button_img_border');
            $('#card_yes').addClass('button_img_border_selected');
            //色
            $('#self_answer_col').removeClass('font_no');
            $('#self_answer_col').addClass('font_yes');
        }else{
            //カード枠
            $('#card_yes').removeClass('button_img_border_selected');
            $('#card_yes').addClass('button_img_border');
            $('#card_no').removeClass('button_img_border');
            $('#card_no').addClass('button_img_border_selected');
            //色
            $('#self_answer_col').removeClass('font_yes');
            $('#self_answer_col').addClass('font_no');
        }
    })
    .fail((error) => {
        console.log(error.statusText);
    });
}
</script>
@endsection