@extends('layout.admin.common',['title'=>'管理者ログイン'])
@section('content')
    <div class="admin_form_div text_center">
		<form action="{{ route('admin.login_store') }}" method="post" class="admin_form">
		    @csrf
		    <label class="form_label">管理者パスワード</label><br/>
		    <input type="password" name="password" class="input_text w_250 mb_10" maxlength="20"><br/>
		    <input type="submit" class="main_button" value="ログイン">
		</form>
    </div>
@endsection