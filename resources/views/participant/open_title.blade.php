@extends('layout.common_paticipant',['title'=>'会議閲覧','participant'=>$participant])
@section('content')
<div class="text_center meeting_create">
    <p class="litte_bold_text">今回のテーマは……</p>
    <p class="font_size_20"><span>{{ $participant->meeting->title }}</span></p>
</div>
@endsection