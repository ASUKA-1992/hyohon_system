@extends('layout.admin.common',['title'=>'会議一覧'])
@section('content')
    <div class="text_center link_text">
        <a href="{{ route('meeting.create') }}">新規作成</a>
    </div>

    <ul>
    @foreach ($meetings as $meeting)
        <li>
            <span>会議作成日:</span>{{ $meeting->created_at }}<br>
            <a href="{{ route('meeting.show', $meeting->id) }}">{{ $meeting->title }}</a>
            {{ config("const.meetings.status")[$meeting->status] }}
        </li>
    @endforeach
    </ul>

@endsection