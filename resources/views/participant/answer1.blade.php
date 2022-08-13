@extends('layout.common_paticipant',['title'=>'会議閲覧','participant'=>$participant])
@section('content')
<div class="text_center meeting_create">
	<p class="litte_bold_text">いずれかの意見を選択してください。</p>
	<div class="mb_10">
    	<button class="button_yes" onclick="click_answer('1', 'YES')">YES</button>
        <button class="button_no" onclick="click_answer('0', 'NO')">NO</button>
	</div>
	
	<div>
		<p>あなたの意見:
			@if(is_null($participant->answer1))
				<span id="self_answer_col">-</span>
			@else
				<span id="self_answer_col">{{ config("const.participants.answer")[$participant->answer1] }}</span>
			@endif
		</p>
	</div>
</div>

<script>
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
        url: "{{ $participant->id }}/meeting1_select",
        data: {'answer':answer},
        dataType: "json",
    })
    .done((res) => {
        $("#self_answer_col").text(answer_text);
    })
    .fail((error) => {
        console.log(error.statusText);
    });
}
</script>
@endsection