@extends('layout.pc_common',['title'=>'会議一覧'])
@section('content')
    <div class="text_center">
        
        @if($login_admin)
        	<div class="link_text">
            	<a href="{{ route('meeting.create') }}">新規作成</a>
        	</div>
        @else
            <div class="litte_bold_text">会議開始前のテーマ閲覧、会議作成・削除は管理者のみ可能です。</div>
        @endif
        
        <form action="" method="get" class="admin_form">
	        <select name="search" class="w_75">
	        	<option value="all">全会議</option>
	        	<option value="active" @if($search == "active") selected="selected" @endif>終了前</option>
	        	<option value="finish" @if($search == "finish") selected="selected" @endif>終了済</option>
	        </select>
	        <input type="submit" class="" value="絞込み">
	    </form>

        @if(count($meetings) > 0)
            <table class="elm_center admin_table">
                <tr>
                    <th class="w_150">{{ config("const.label.meeting_name") }}</th>
                    <th class="w_150">{{ config("const.label.meeting_title") }}</th>
                    <th class="w_150">{{ config("const.label.tag") }}</th>
                    <th class="w_100">{{ config("const.label.owner") }}</th>
                    <th class="w_100">{{ config("const.label.status") }}</th>
                    <th class="w_100">会議開始</th>
                    <th class="w_100">会議1終了</th>
                    <th class="w_100">会議2終了</th>
                    <th class="w_50">参加</th>
                    <th class="w_50">リンクコピー</th>
                    @if($login_admin)
                    	<th class="w_50">コメント</th>
                        <th class="w_50">削除</th>
                    @endif 
                </tr>
                    @foreach ($meetings as $meeting)
                        <tr>
                            <td class="text_left">
                                <a href="{{ route('meeting.show', $meeting->id) }}" class="under_line_text">{{ $meeting->name }}</a>
                            </td>
                            <td class="text_left">
                            	@if($login_admin || $meeting->status > 1)
                            		{{ $meeting->title }}
                            	@else
                            		-
                               	@endif
                            </td>
                            <td>{{ is_null($meeting->tag) ? "-" : $meeting->tag }}</td>
                            <td>{{ $meeting->participants[0]->name }}</td>
                            <td>{{ config("const.meetings.status")[$meeting->status] }}</td>
                            <td>{{ is_null($meeting->start_date) ? "-" : $meeting->start_date->format('Y/m/d H:i'); }}</td>
                            <td>{{ is_null($meeting->status1_end_date) ? "-" : $meeting->status1_end_date->format('Y/m/d H:i'); }}</td>
                            <td>{{ is_null($meeting->status2_end_date) ? "-" : $meeting->status2_end_date->format('Y/m/d H:i'); }}</td>
                            <td><a href="{{ route('participant.index', $meeting->id) }}" class="under_line_text">参加</a></td>
                            <td><a onclick="copyUrl('{{ route('participant.index', $meeting->id) }}')" class="under_line_text">リンクコピー</a></td>
                            @if($login_admin)
                            	<td>
                            		<a href="{{ route('meeting.comment', $meeting->id) }}" class="under_line_text">コメント</a>
                            	
                            	</td>
                                <td class="text_center">
                                    <form action="{{ action('App\Http\Controllers\MeetingController@destroy', $meeting->id) }}?search={{ $search }}" id="form_{{ $meeting->id }}" method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <a href="#" data-id="{{ $meeting->id }}" class="link_text" onclick="deletePost(this);">削除</a>
                                    </form>                     
                                </td>
                            @endif  
                        </tr>
                    @endforeach
                </ul>
            </table>
        @else
            <div>会議が存在しません</div>
        @endif
    </div>

    <script>
        function deletePost(e) {
            if (confirm('本当に削除していいですか?')) {
                document.getElementById('form_' + e.dataset.id).submit();
            }
        }

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