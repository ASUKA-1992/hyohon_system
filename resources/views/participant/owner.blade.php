@extends('layout.common',['title'=>'会議閲覧'])
@section('content')
    <div class="text_center meeting_create">
        <div class="litte_bold_text">{{ config('const.label.meeting_name') }}</div>
        <div class="font_size_20">{{ $participant->meeting->name }}</div>
        <div class="litte_bold_text">{{ config('const.label.meeting_title') }}</div>
        <div class="font_size_20">{{ $participant->meeting->title }}</div>

        <ul>
            <li>
                <a class="wide_button @if($status==1) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 1]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">会議開示前</a>
            </li>
         
            <li>
                <a class="wide_button @if($status==2) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 2]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">テーマ開示</a>
            </li>

            <li>
                <a class="wide_button @if($status==3) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 3]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">役割開示</a>
            </li>

            <li>
                <a class="wide_button @if($status==4) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 4]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">初期意見</a>
            </li>

            <li>
                <a class="wide_button @if($status==5) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 5]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">会議①</a>
            </li>

            <li>
                <a class="wide_button @if($status==6) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 6]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">会議①終了</a>
            </li>

            <li>
                <a class="wide_button @if($status==7) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 7]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">アクション開示</a>
            </li>

            <li>
                <a class="wide_button @if($status==8) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 8]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">会議②</a>
            </li>

            <li>
                <a class="wide_button @if($status==9) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 9]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">最終決議</a>
            </li>

            <li>
                <a class="wide_button @if($status==10) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 10]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">結果発表</a>
            </li>
            
            <li>
                <a class="wide_button @if($status==99) current_status @endif"
                    href="{{ route('participant.status_change', [$participant->id, 99]) }}" 
                    onclick="return confirm('ステータスを変更します。よろしいですか？')">終了</a>
            </li>
        </ul>

        <table class="elm_center paticipans_table" id="show_div_table">
            <tr>
                <th class="w_150">参加者名</th>
                <th class="w_150">{{ config("const.label.role") }}</th>
                <th class="w_75">初期意見</th>
                <th class="w_150">{{ config("const.label.action") }}</th>
                <th class="w_75">最終意見</th>
            </tr>
            @foreach ($participants as $participant)
                @if($participant->owner_type == 2) @continue @endif
                <tr class="@if(is_null($participant->name)) gray_back @endif">
                    <td>@if(is_null($participant->name)) 未設定 @else {{ $participant->name }} @endif</td>
                    <td class="@if($participant->role_open==0) gray_back @endif">
                        {{ $participant->role_name }}
                    </td>
                    <td>
                        @if(isset($participant->answer1)) {{ config("const.participants.answer")[$participant->answer1] }} @else - @endif
                    </td>
                    <td class="@if($participant->action_open==0) gray_back @endif">
                        {{ $participant->action_name }}
                    </td>
                    <td>
                        @if(isset($participant->answer2)) {{ config("const.participants.answer")[$participant->answer2] }} @else - @endif
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="font_size_12 w_225 elm_center text_left">
            <ul>
                <li><span class="bold">{{ config("const.label.owner") }}</span>: {{ $participant->meeting->participants[0]->name }}</li>
                <li><span class="bold">{{ config("const.label.tag") }}</span>: {{ is_null($participant->meeting->tag) ? "-" : $participant->meeting->tag }}</li>
                <li><span class="bold">{{ config("const.label.status") }}</span>: {{ config("const.meetings.status")[$participant->meeting->status] }}</li>
                <li><span class="bold">会議作成</span>: {{ $participant->meeting->created_at->format('Y/m/d H:i'); }}</li>
                <li><span class="bold">会議1終了</span>: {{ is_null($participant->meeting->status1_end_date) ? "-" : $participant->meeting->status1_end_date->format('Y/m/d H:i'); }}</li>
                <li><span class="bold">会議2終了</span>: {{ is_null($participant->meeting->status2_end_date) ? "-" : $participant->meeting->status2_end_date->format('Y/m/d H:i'); }}</li>
            </ul>
        </div>
        
        <div>
        	<button id="next_button" class="min_button" onclick="reload()">画面更新</button>
        </div>

        <a href="{{ route('participant.index', $participant->meeting->id) }}" class="min_button">待機所に戻る</a>
    </div>
    
    <script>
    	function reload(){
	        window.location.reload();
        }
	</script>
@endsection