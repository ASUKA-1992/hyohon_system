@extends('layout.admin.common',['title'=>'管理画面'])
@section('content')
    <div class="text_center">
        <a href="{{ route('theme.index') }}" class="main_button">テーマ一覧</a>
        <a href="{{ route('role.index') }}" class="main_button">役割一覧</a>
        <a href="{{ route('action.index') }}" class="main_button">アクション一覧</a>
    </div>
    
	<div class="font_size_12 w_400 elm_center text_left">
    	<ul>
			<li><span class="bold">テーブル定義書</span>: <a href="https://docs.google.com/spreadsheets/d/1P3Sabmt6DTKwmn7Nqoby2dBVmbEuGq5iVD55fZ915LU/edit#gid=0" target="_blank" class="link_text">Googleスプレッドシート</a></li>
			<li><span class="bold">githubレポジトリ</span>: <a href="https://github.com/ASUKA-1992/hyohon_system" target="_blank" class="link_text">https://github.com/ASUKA-1992/hyohon_system</a></li>
		</ul>
	</div>
@endsection