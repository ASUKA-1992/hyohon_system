@extends('layout.admin.common',['title'=>'枠割一覧'])
@section('content')
    <div class="text_center link_text">
        <a href="./action/create">新規作成</a>
    </div>
    <table class="elm_center admin_table">
        <th class="w_250">アクション名</th>
        <th class="w_150">アクション区分</th>
        <th class="w_50">編集</th>
        <th class="w_50">削除</th>
        @foreach ($actions as $action)
        <tr class="active_row_{{ $action->active_flg }}">
            <td>{{ $action->name }}</td>
            <td>{{ config("const.actions.name_sub")[$action->name_sub] }}</td>
            <td class="text_center"><a href="{{ route('action.edit', $action->id) }}" class="link_text">編集</a></td>
            <td class="text_center">
                <form action="{{ action('App\Http\Controllers\Admin\ActionController@destroy', $action->id) }}" id="form_{{ $action->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a href="#" data-id="{{ $action->id }}" class="link_text" onclick="deletePost(this);">削除</a>
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