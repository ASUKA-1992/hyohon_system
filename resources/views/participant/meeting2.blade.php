@extends('layout.common_paticipant',['title'=>'会議閲覧'])
@section('content')
<div class="text_center meeting_create">
    <img src="{{ asset('/assets/images/meeting_images/' . $participant_name_cnt . '.jpg') }}" alt="会議イラスト" width="100%">

    <div class="mb_10">
        <table class="elm_center paticipans_table">
            <tr>
                <th class="w_150">参加者名</th>
                <th class="w_75">{{ config("const.label.role") }} </th>
                <th class="w_75">アクション</th>
                <th class="w_75">初期意見</th>
            </tr>
            @foreach ($participants as $target)
            @if($target->owner_type == 2) @continue @endif
            @if(is_null($target->name))
                @continue
            @endif
            <tr @if($target->id == $participant->id) class="self_answer_row" @endif>
                <td>{{ $target->name }}
                    @if($target->owner_type != 1)
                        <br/>(ファシリテーター/{{ config("const.participants.owner_type")[$target->owner_type] }})
                    @endif
                </td>
                <td>
                    @if($target->owner_type == 2)
                        -
                    @else
                        <span class="bold">{{ $target->role_name }}</span>
                    @endif
                </td>
                <td>
                    @if($target->owner_type == 2)
                        -
                    @else
                        <span class="bold">{{ $target->action_name }}</span>
                    @endif
                </td>
                <td>
                    @if(isset($target->answer1))
                        {{ config("const.participants.answer")[$target->answer1] }}
                    @elseif($target->owner_type == 2)
                        -
                    @else
                        ?
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    @if( ($participant->owner_type == 2 || $participant->owner_type == 3))
        <div>
        	@if($participant->meeting->status == 2)
	            <a href="{{ route('participant.meeting2_finish', $participant->id) }}" class="main_button"
	                onclick="return confirm('最終決議に進みます。よろしいですか？')">最終決議に進む</a>
	        @else
	        	<a href="{{ route('participant.meeting21_finish', $participant->id) }}" class="main_button"
	                onclick="return confirm('会議を終了します。よろしいですか？')">会議を終了する</a>
	        @endif
        </div>
    @endif

</div>
@endsection