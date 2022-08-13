@extends('layout.common_paticipant',['title'=>'会議閲覧','participant'=>$participant])
@section('content')
<div class="text_center meeting_create">
	<div class="mb_10">
		結果は...<span class="bold font_size_20">{{ $meeting_result }}</span>でした!
	</div>
    <div id="show_div_message" class="mb_10 font_size_12 manual_area meeting_create line_height_15">
		みなさま、ご納得の行く結果になりましたでしょうか？<br/>
		この結果をもとに、新たな制度や条例、取り組みが始まるかもしれません。<br/>
		残念ながらご納得の行く結果にならなかった方にも、大変貴重なご意見をいただけたこと、感謝しております。<br/>
		みなさま、本当にありがとうございました。
	</div>
</div>
@endsection