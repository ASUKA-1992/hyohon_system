@extends("layout.explode.common",["title"=>"EDIT"])
@section("content")
    <div class="admin_form_div text_center">
        <div class="">
            <a class="link_text" href="../../explode">トップ画面へ</a>
            <div>■更新■</div>
        </div>
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="{{ route('explode.update', ['id'=>$explode->id]) }}" method="post" class="admin_form">
            @csrf
            @method('patch')
            <div class="text_left">
                <label class="form_label">登録者ニックネーム</label><br/>
                <input type="text" name="name" class="input_text w_250 mb_10" maxlength="10"
                    value="{{old('name') ?? $explode->name}}">

                <label class="form_label disp_none">備考(任意)</label>
                <input type="text" name="note" class="input_text w_250 mb_10 disp_none" maxlength="100"
                    value="{{old('note') ?? $explode->note}}">

                <label class="form_label">粒子の出てくる場所</label><br/>
                <select name="place" class="w_250 mb_10 select_white_border" id="place_pulldown">
                    @foreach (config("const.explodes.place") as $key => $value)
                        @if($explode->place == $key)
                            <option value="{{ $key }}" selected="selected">{{ $value }}</option>
                        @else
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endif
                    @endforeach
                </select><br/>
                <img class="img_100per" id="place_img" src="{{ asset('/assets/images/explode/place/1.png') }}" alt="場所" /><br/>

                <label class="form_label">粒子の速さ</label><br/>
                <select name="speed" class="w_250 mb_10 select_white_border">
                    <option value="5" {{ ($explode->speed == 5) ? 'selected=selected' : ''}}>かなり遅い</option>
                    <!--<option value="10" {{ ($explode->speed == 10) ? 'selected=selected' : ''}}>かなり遅い</option>-->
                    <option value="30" {{ ($explode->speed == 30) ? 'selected=selected' : ''}}>やや遅い</option>
                    <option value="50" {{ ($explode->speed == 50) ? 'selected=selected' : ''}}>普通</option>
                    <option value="70" {{ ($explode->speed == 70) ? 'selected=selected' : ''}}>やや早い</option>
                    <option value="100" {{ ($explode->speed == 100) ? 'selected=selected' : ''}}>かなり早い</option>
                    <!--<option value="100" {{ ($explode->speed == 100) ? 'selected=selected' : ''}}>早さMAX</option>-->
                </select><br/>

                <label class="form_label">粒子の量</label><br/>
                <select name="quantity" class="w_250 mb_10 select_white_border">
                    <option value="5" {{ ($explode->quantity == 5) ? 'selected=selected' : ''}}>かなり少ない</option>
                    <!--<option value="10" {{ ($explode->quantity == 10) ? 'selected=selected' : ''}}>かなり少ない</option>-->
                    <option value="30" {{ ($explode->quantity == 30) ? 'selected=selected' : ''}}>やや少ない</option>
                    <option value="50" {{ ($explode->quantity == 50) ? 'selected=selected' : ''}}>普通</option>
                    <option value="70" {{ ($explode->quantity == 70) ? 'selected=selected' : ''}}>やや多い</option>
                    <option value="90" {{ ($explode->quantity == 90) ? 'selected=selected' : ''}}>かなり多い</option>
                    <!--<option value="100" {{ ($explode->quantity == 100) ? 'selected=selected' : ''}}>多さMAX</option>-->
                </select><br/>

                <label class="form_label">粒子の大きさ</label><br/>
                <select name="size" class="w_250 mb_10 select_white_border">
                    <option value="10" {{ ($explode->size == 10) ? 'selected=selected' : ''}}>かなり小さい</option>
                    <option value="20" {{ ($explode->size == 20) ? 'selected=selected' : ''}}>やや小さい</option>
                    <!--<option value="30" {{ ($explode->size == 30) ? 'selected=selected' : ''}}>やや小さい</option>-->
                    <option value="30" {{ ($explode->size == 30) ? 'selected=selected' : ''}}>普通</option>
                    <option value="50" {{ ($explode->size == 50) ? 'selected=selected' : ''}}>やや大きい</option>
                    <option value="70" {{ ($explode->size == 70) ? 'selected=selected' : ''}}>かなり大きい</option>
                    <!--<option value="100" {{ ($explode->size == 100) ? 'selected=selected' : ''}}>大きさMAX</option>-->
                </select><br/>

                <label class="form_label disp_none">粒子の大きさ変化</label>
                <select name="front_bigger" class="w_250 mb_10 disp_none">
                    <option value="1" {{ ($explode->front_bigger == 1) ? 'selected=selected' : ''}}>アリ</option>
                    <option value="0" {{ ($explode->front_bigger == 0) ? 'selected' : ''}}>ナシ</option>
                </select>

                <label class="form_label">粒子の色</label><br/>
                <input type="number" id="color_num" name="color_num" class="input_text disp_none" max=5 min=1 
                    value="{{ count($color_num) }}">
                <button type="button" onclick="display_color_input('plus')">追加</button>
                <button type="button" onclick="display_color_input('minus')">削除</button><br/>
                <div class="mb_10">
                    <input type="color" name="color_1" id="color_1"
                        value="{{ $color_num[0] }}">
                    <input type="color" name="color_2" id="color_2"
                        value="{{ isset($color_num[1]) ? $color_num[1] : '#ffffff' }}"
                        class="{{ isset($color_num[1]) ? '' : 'disp_none' }}">
                    <input type="color" name="color_3" id="color_3"
                        value="{{ isset($color_num[2]) ? $color_num[2] : '#ffffff' }}"
                        class="{{ isset($color_num[2]) ? '' : 'disp_none' }}">
                    <input type="color" name="color_4" id="color_4"
                        value="{{ isset($color_num[3]) ? $color_num[3] : '#ffffff' }}"
                        class="{{ isset($color_num[3]) ? '' : 'disp_none' }}">
                    <input type="color" name="color_5" id="color_5"
                        value="{{ isset($color_num[4]) ? $color_num[4] : '#ffffff' }}"
                        class="{{ isset($color_num[4]) ? '' : 'disp_none' }}">
                </div>
                
                <label class="form_label">継続秒数(1~10秒まで)</label><br/>
                <input type="number" name="count" class="input_text w_250 mb_10" min="1" max="10"
                value="{{old('count') ?? $explode->count}}">

				<div class="{{ !is_null($login_admin) ? '' : 'disp_none' }}">
	            	<label class="form_label">会議</label>
	                <select name="order" class="w_250 mb_10 select_white_border" id="">
		            	@foreach ($whokshops as $whokshop)
		                	@if($whokshop->id == $explode->order)
		                    	<option value="{{ $whokshop->id }}" selected="selected">{{ $whokshop->name }}</option>
		                    @else
		                        <option value="{{ $whokshop->id }}">{{ $whokshop->name }}</option>
		                    @endif
		               @endforeach
		           </select>
	             </div>
            </div>
            <input type="submit" class="main_button" value="登録">
        </form>
    </div>

    <script>
        function display_color_input(plus_minus){
            var org_color_num = $('#color_num').val(); //色数取得
            var color_num = parseInt(org_color_num); //数値変換
            if(isNaN(color_num)) color_num = 1; //数値でなければ1にする
            if(plus_minus == 'plus'){
                color_num = color_num + 1;
            }else{
                color_num = color_num - 1;
            }
            if(color_num < 1) color_num = 1; //0以下なら1にする
            if(color_num > 5) color_num = 5; //6以上なら5にする
            $('#color_num').val(color_num);
            //入力フォーム表示設定
            for(var i=1; i<=5; i++){
                if(color_num < i){
                    $('#color_'+i).hide();
                }else{
                    $('#color_'+i).show();
                }                
            }
        }

        window.onload = function(){
            place_pulldown();
        }

        
        document.getElementById("place_pulldown").onchange = function(){
            place_pulldown();
        };

        function place_pulldown(){
            var place = document.getElementById("place_pulldown");
            var img_path = "{{ asset('/assets/images/explode/place/') }}/" + place.value + ".png";
            $('#place_img').attr('src',img_path);
        }
    </script>
@endsection