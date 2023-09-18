@extends('layout.explode.common',['title'=>'喜びを可視化する/LIST'])
@section('content')
    <div class="text_center">
        <span class="font_size_20">"喜び"の可視化と"喜び"についての対話。</span><br/>
        <span class="font_size_15">喜び可視化システム</span>
    </div>
    
    <table class="elm_center admin_table disp_none">
        <th class="w_50 disp_none">order</th>
        <th class="w_250">登録者ニックネーム</th>
        <th class="w_250 disp_none">note</th>
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

    @if(!is_null($login_admin))
    	<div class="text_center link_text">
	        <a href="./explode/explode_workshop/create">会議登録</a>
	    </div>
    @endif
	<table class="elm_center admin_table">
		<th class="w_50">会議ID</th>
	    <th class="w_150">実施日</th>
	    <th class="w_100">会議名</th>
	    @if(!is_null($login_admin))
		    <th class="w_50">編集</th>
		@endif
	    @foreach ($whokshops as $whokshop)
	    	<tr class="">
	    		 <td class="text_center">{{ $whokshop->id }}</td>
	    		 <td class="text_center">{{ $whokshop->workshop_date($whokshop->id) }}</td>
	    		 <td class="text_left">
	    		 	<a href="{{ route('explode_workshop.show', $whokshop->id) }}" class="under_line_text">{{ $whokshop->name }}</a>
	    		 </td>
	    		 @if(!is_null($login_admin))
		    		 <td class="text_center"><a href="{{ route('explode_workshop.edit', $whokshop->id) }}" class="link_text">編集</a></td>
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