@extends('layout.admin.common',['title'=>'枠割一覧'])
@section('content')
    <div class="text_center link_text">
        <a href="./role/create">新規作成</a>
    </div>
    <table class="elm_center admin_table">
        <th class="w_250">役割名</th>
        <th class="w_150">役割区分</th>
        <th class="w_50">編集</th>
        <th class="w_50">削除</th>
        @foreach ($roles as $role)
        <tr class="active_row_{{ $role->active_flg }}">
            <td>{{ $role->name }}</td>
            <td>{{ config("const.roles.name_sub")[$role->name_sub] }}</td>
            <td class="text_center"><a href="{{ route('role.edit', $role->id) }}" class="link_text">編集</a></td>
            <td class="text_center">
                <form action="{{ action('App\Http\Controllers\Admin\RoleController@destroy', $role->id) }}" id="form_{{ $role->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a href="#" data-id="{{ $role->id }}" class="link_text" onclick="deletePost(this);">削除</a>
                </form>      
            </td>
        </tr>
        @endforeach
    </table>

    <script>
        function deletePost(e) {
            if (confirm('本当に削除していいですか?')) {
                document.getElementById('form_' + e.dataset.id).submit();
            }
        }
    </script>
@endsection