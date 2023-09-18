@extends('layout.common_paticipant',['title'=>'会議閲覧','participant'=>$participant])
@section('content')
<div class="text_center meeting_create">
    <p id ="main_text" class="font_size_20">
        {{ $participant->name }}さん お疲れ様でした。<br/>
        会議の再開前までお待ちください。
    </p>
</div>
@endsection