@extends('layout.common',['title'=>'トップページ'])
@section('content')
    <div id="top" class="text_center">
        <div>
            <a href="{{ route('meeting.select_meeting') }}" class="top_button top_button_1">会議に<br/>参加する</a>
            <a href="{{ route('meeting.index') }}" class="top_button top_button_2">会議の<br/><span class="font_size_20">一覧を見る
            <span></a>
        </div>
        <div>
            <ul>
            	@if(!is_null($login_admin))
	                <li><a href="{{ route('meeting.create') }}" class="main_button">会議を作成する</a></li>
	                <li><a href="./admin" class="main_button">管理画面</a></li>
	            @endif
                <li>
                	<a href="./admin/login" class="main_button">管理者@if($login_admin)ログアウト@elseログイン@endif</a>
                </li>
            </ul>
        </div>
    </div>
@endsection