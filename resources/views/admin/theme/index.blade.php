@extends('layout.admin.common',['title'=>'枠割一覧'])
@section('content')
    <div class="text_center link_text">
        <a href="./theme/create">新規作成</a>
    </div>
    <table class="elm_center admin_table">
        <th class="w_350">テーマ名</th>
        <th class="w_400">備考</th>
        <th class="w_50">編集</th>
        <th class="w_50">削除</th>
        @foreach ($themes as $theme)
        <tr class="active_row_{{ $theme->active_flg }}">
            <td>{{ $theme->name }}</td>
            <td>{{ $theme->note }}</td>
            <td class="text_center"><a href="{{ route('theme.edit', $theme->id) }}" class="link_text">編集</a></td>
            <td class="text_center">
                <form action="{{ action('App\Http\Controllers\Admin\ThemeController@destroy', $theme->id) }}" id="form_{{ $theme->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a href="#" data-id="{{ $theme->id }}" class="link_text" onclick="deletePost(this);">削除</a>
                </form>      
            </td>
        </tr>
        @endforeach
    </table>

    <script>
        function deletePost(e) {
            'use strict';
            
            if (confirm('本当に削除していいですか?')) {
                document.getElementById('form_' + e.dataset.id).submit();
            }
        }
    </script>
@endsection