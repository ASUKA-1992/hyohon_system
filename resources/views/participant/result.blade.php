@extends('layout.common_paticipant',['title'=>'会議閲覧','participant'=>$participant])
@section('content')
<div class="text_center meeting_create">
	@if($meeting_result == "YES")
	<div class="mt_10 mb_10 manual_area manual_area_yes font_yes">
	@else
	<div class="mt_10 mb_10 manual_area manual_area_no font_no">
	@endif
		結果は...<span class="bold font_size_20">{{ $meeting_result }}</span>でした!
	</div>
    <div id="show_div_message" class="mb_10 font_size_12 meeting_create line_height_15 opacity0">
		みなさま、ご納得の行く結果になりましたでしょうか？<br/>
		この結果をもとに、新たな制度や条例、取り組みが始まるかもしれません。<br/>
		残念ながらご納得の行く結果にならなかった方にも、大変貴重なご意見をいただけたこと、感謝しております。<br/>
		みなさま、本当にありがとうございました。
	</div>
</div>

<script type="text/javascript">
window.onload = changeOpacity(0, 1);
function changeOpacity( $a, $b ) {
    document.getElementById( "show_div_message" ).disabled = true;
    var $intervalID = setInterval(
        function(){
            main();
        },
        100
    );
    function main() {
        var $targetElement = document.getElementById( "show_div_message" );
        $a = $a + 0.01;
        if( $a <= $b ){
            $targetElement.style.cssText = "opacity:" + $a + ";";
        }
    }
}
</script>
@endsection