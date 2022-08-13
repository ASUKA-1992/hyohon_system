@extends('layout.common',['title'=>'会議閲覧'])
    @section('content')
    <div class="text_center">
        <div class="litte_bold_text">{{ config('const.label.meeting_name') }}</div>
        <div class="font_size_20">{{ $meeting->name }}</div>     

        @if($login_admin)
            <div class="litte_bold_text">{{ config('const.label.meeting_title') }}</div>
            <div class="font_size_20">{{ $meeting->title }}</div>
        @endif

        <div class="mb_20 font_size_12">
            <a class="link_text" onclick="copyUrl('{{ route('participant.index', $meeting->id) }}')">参加URLコピー</a>
        </div>

        @if($meeting->status == 99)
            <div class="mb_10">
                結果は...<span class="bold font_size_20">{{ $meeting_result }}</span>でした!
            </div>
        @endif

        <table class="elm_center paticipans_table disp_none" id="show_div_table">
            <tr>
                <th class="w_150">参加者名</th>
                @if($meeting->status == 99 || $login_admin)
                    <th class="w_150">{{ config("const.label.role") }}</th>
                    <th class="w_150">{{ config("const.label.action") }}</th>
                    <th class="w_75">初期意見</th>
                    <th class="w_75">最終意見</th>
                @endif
            </tr>
            @foreach ($participants as $participant)
                @if($participant->owner_type == 2) @continue @endif
                @if($meeting->status == 99 && is_null($participant->name)) @continue @endif
                <tr>
                    <td>@if(is_null($participant->name)) 未設定 @else {{ $participant->name }} @endif</td>
                    @if($meeting->status == 99 || $login_admin)
                        <td>{{ $participant->role_name }}</td>
                        <td>{{ $participant->action_name }}</td>
                        <td>@if(isset($participant->answer1)) {{ config("const.participants.answer")[$participant->answer1] }} @else - @endif</td>
                        <td>@if(isset($participant->answer2)) {{ config("const.participants.answer")[$participant->answer2] }} @else - @endif</td>
                    @endif
                </tr>
            @endforeach
        </table>

        <div class="font_size_12 w_225 elm_center text_left">
            <ul>
                <li><span class="bold">{{ config("const.label.owner") }}</span>: {{ $meeting->participants[0]->name }}</li>
                <li><span class="bold">{{ config("const.label.tag") }}</span>: {{ is_null($meeting->tag) ? "-" : $meeting->tag }}</li>
                <li><span class="bold">{{ config("const.label.status") }}</span>: {{ config("const.meetings.status")[$meeting->status] }}</li>
                <li><span class="bold">会議作成</span>: {{ $meeting->created_at->format('Y/m/d H:i'); }}</li>
                <li><span class="bold">会議1終了</span>: {{ is_null($meeting->status1_end_date) ? "-" : $meeting->status1_end_date->format('Y/m/d H:i'); }}</li>
                <li><span class="bold">会議2終了</span>: {{ is_null($meeting->status2_end_date) ? "-" : $meeting->status2_end_date->format('Y/m/d H:i'); }}</li>
                <li><span class="bold">{{ config("const.label.comment") }}</span>: {{ is_null($meeting->comment) ? "-" : $meeting->comment }}</li>
            </ul>
        </div>

        <div>
            <a href="{{ route('top') }}" class="main_button">トップへ戻る</a>
        </div>
    </div>

    <script>
        @if($request->jst_fns == 1)
            $('#show_div_message').fadeIn(4000);
            $('#show_div_table').fadeIn(8000);
        @else
            $('#show_div_message').removeClass("disp_none");
            $('#show_div_table').removeClass("disp_none");
        @endif

        
        function copyUrl(copy_url){
            const element = document.createElement('input');
            element.value = copy_url;
            document.body.appendChild(element);
            element.select();
            document.execCommand('copy');
            document.body.removeChild(element);
            alert("参加URLをコピーしました。\n"+ copy_url)
        }
    </script>
@endsection