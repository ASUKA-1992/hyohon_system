@extends('layout.common',['title'=>'会議別参加者一覧'])
@section('content')
    <div class="text_center meeting_create">
    	<div class="">
    		<div class="bold">待機室</div>
    		<a class="link_text" onclick="copyUrl('{{ route('participant.index', $meeting->id) }}')">参加URLコピー</a>
            @if(isset($login_admin))
                 / <a class="link_text" href="{{ route('participant.show', $owner->id) }}">ファシリテーター用画面へ</a>
            @endif
    	</div>
    
    	<div class="bordr_top mt_10">
	    	<div class="litte_bold_text">{{ config('const.label.meeting_name') }}</div>
	        <div class="font_size_20">{{ $meeting->name }}</div>
        </div>
        <div class="">
            <div class="litte_bold_text">{{ config('const.label.status') }}</div>
            <img src="{{ asset('/assets/images/paticipant_status/'.config("const.meetings.status_en")[$meeting->status].'.png') }}" alt="ステータスバー" width="100%">
	    </div>

        <div class="">参加者数:{{ $participant_cnt }}</div>
        @if( $no_name_cnt > 0 )
            <div class="font_size_12 error_text">{{ $no_name_cnt }}人の参加者が名前未登録です</div>
            <a class="link_text" href="{{ route('participant.input_name', $meeting->id) }}">名前を登録する</a>
        @endif
        
        <ul>
            @foreach ($participants as $participant)
            	@if($participant->owner_type != 1)
            		@continue;
            	@endif
                @if(!is_null($participant->name))
                    <li>
                        <a href="{{ route('participant.show', $participant->id) }}" class="wide_button"
                            onclick="return confirm('あなたは{{ $participant->name }}さんで間違いないですか?')">
                            {{ $participant->name }}
                            @if($participant->owner_type != 1) (ファシリテーター) @endif
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <script>
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