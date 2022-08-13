@extends('layout.common',['title'=>'会議選択'])
@section('content')
    <div class="text_center meeting_create">
        @if(count($meetings) > 0)
            <ul>
            @foreach ($meetings as $meeting)
                <li>
                    <a href="{{ route('participant.index', $meeting->id) }}" class="wide_button">
                        <div class="mb_10 font_size_15">
                            {{ $meeting->name }}
                            @if($meeting->tag)
                                <br/>
                                <span class="font_size_12">({{ $meeting->tag }})</spap>
                            @endif
                        </div>
                        <div><span class="bold">会議作成日:</span>{{ $meeting->created_at->format('Y/m/d H:i') }}</div><br/>
                        <div><span class="bold">ステータス:</span>{{ config("const.meetings.status")[$meeting->status] }}</div>
                    </a>
                </li>
            @endforeach
            </ul>
        @else
            <div>アクティブな会議が存在しません</div>
        @endif
    </div>
@endsection