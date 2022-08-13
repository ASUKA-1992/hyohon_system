@extends('layout.admin.common',['title'=>'マスタ管理'])
@section('content')
    <div class="text_center">
        <a href="{{ route('theme.index') }}" class="main_button">テーマ一覧</a>
        <a href="{{ route('role.index') }}" class="main_button">役割一覧</a>
        <a href="{{ route('action.index') }}" class="main_button">アクション一覧</a>
    </div>
@endsection