@extends('layout.common',['title'=>'メッセージ'])
@section('content')
    <div id="message" class="text_center">
        {{ $message }}
        <div>
            <ul>
                <li><a href="{{ route('top') }}" class="main_button">トップへ戻る</a></li>
            </ul>
        </div>
    </div>
@endsection