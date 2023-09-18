@extends('layout.explode.common',['title'=>'喜びを可視化する/LIST'])
@section('content')
    <div class="text_center">
        <span class="font_size_20">"喜び"の可視化と"喜び"についての対話</span><br/>
        <span class="font_size_15">{{$whokshop->name}}</span>
    </div>
    <div class="text_center link_text">
        @if(!is_null($login_admin))
            <a href="../../explode_honban?workshop_id={{$whokshop->id}}">投影用画面</a><br/>
        @endif
        <a href="../../explode/create?workshop_id={{$whokshop->id}}">新規登録</a>
    </div>
    
    <table class="elm_center admin_table">
        <th class="w_50 disp_none">order</th>
        <th class="w_200">登録者ニックネーム</th>
        <th class="w_250 disp_none">note</th>
        <th class="w_150">登録日時</th>
        <th class="w_50">編集</th>
        @if(!is_null($login_admin))
            <th class="w_50">削除</th>
        @endif
        @foreach ($explodes as $explode)
        <tr class="active_row_{{ $explode->active_flg }}">
            <td class="text_left disp_none">{{ $explode->order }}</td>
            <td class="text_left">
                <a href="{{ route('explode.sample_2023', $explode->id) }}" class="under_line_text">{{ $explode->name }}さん</a>
            </td>
            <td class="text_left disp_none">
                {{ isset($explode->note)? $explode->note : "-" }}
            </td>
            <td class="">{{ $explode->created_at }}</td>
            <td class="text_center">
                <a href="{{ route('explode.edit', $explode->id) }}" class="link_text"
                            onclick="return confirm('あなたは{{ $explode->name }}さんでよろしいですか?')">
                            編集
                </a>
            </td>
            @if(!is_null($login_admin))
                <td class="text_center">
                    <form action="{{ action('App\Http\Controllers\ExplodeController@destroy', $explode->id) }}" id="form_{{ $explode->id }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <a href="#" data-id="{{ $explode->id }}" class="link_text" onclick="deletePost(this);">削除</a>
                    </form>      
                </td>
            @endif
        </tr>
        @endforeach
    </table>

    <div class="text_center font_size_15">
        <div>登録例</div>
    </div>
    <table class="elm_center admin_table">
        @foreach ($example_explodes as $explode)
        <tr class="active_row_{{ $explode->active_flg }}">
            <td class="text_left disp_none">{{ $explode->order }}</td>
            <td class="text_left">
                <a href="{{ route('explode.sample_2023', $explode->id) }}" class="under_line_text">{{ $explode->name }}</a>
            </td>
            <td class="text_left disp_none">
                {{ isset($explode->note)? $explode->note : "-" }}
            </td>
            @if(!is_null($login_admin))
                <td class="text_center"><a href="{{ route('explode.edit', $explode->id) }}" class="link_text">編集</a></td>
                <td class="text_center">
                    <form action="{{ action('App\Http\Controllers\ExplodeController@destroy', $explode->id) }}" id="form_{{ $explode->id }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <a href="#" data-id="{{ $explode->id }}" class="link_text" onclick="deletePost(this);">削除</a>
                    </form>      
                </td>
            @endif
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