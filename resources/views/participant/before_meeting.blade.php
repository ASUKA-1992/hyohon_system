@extends('layout.common_paticipant',['title'=>'会議閲覧','participant'=>$participant])
@section('content')
<div class="text_center meeting_create">
    <p id ="main_text" class="font_size_20">
        {{ $participant->name }}さん ようこそ!<br/>
        会議開始までお待ちください。
    </p>
</div>
@endsection