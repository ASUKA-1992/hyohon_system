@extends('layout.admin.common',['title'=>'管理者ログアウト'])
@section('content')
    <div class="admin_form_div text_center">
		<form action="{{ route('admin.logout') }}" method="post" class="admin_form">
			@csrf
			<input type="submit" class="main_button" value="ログアウト">
		</form>
    </div>
@endsection