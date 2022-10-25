@extends('layout.admin.explode.common',['title'=>'LIST'])
@section('content')
    <div class="text_center link_text">
        <a href="./explode/create">new</a>
    </div>
    <table class="elm_center admin_table">
        <th class="w_50">order</th>
        <th class="w_250">title</th>
        <th class="w_250">note</th>
        <th class="w_50">edit</th>
        <th class="w_50">delete</th>
        @foreach ($explodes as $explode)
        <tr class="active_row_{{ $explode->active_flg }}">
            <td class="text_left">{{ $explode->order }}</td>
            <td class="text_left">
                <a href="{{ route('explode.show', $explode->id) }}" class="under_line_text">{{ $explode->name }}</a>
            </td>
            <td class="text_left">
                {{ isset($explode->note)? $explode->note : "-" }}
            </td>
            <td class="text_center"><a href="{{ route('explode.edit', $explode->id) }}" class="link_text">edit</a></td>
            <td class="text_center">
                <form action="{{ action('App\Http\Controllers\Admin\ExplodeController@destroy', $explode->id) }}" id="form_{{ $explode->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <a href="#" data-id="{{ $explode->id }}" class="link_text" onclick="deletePost(this);">delete</a>
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