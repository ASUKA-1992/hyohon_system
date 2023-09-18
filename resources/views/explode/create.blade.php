@extends("layout.explode.common",["title"=>"NEW"])
@section("content")
    <div class="admin_form_div text_center">
        <div class="">
            <a class="link_text" href="../explode">トップ画面へ</a>
            <div>■新規作成■</div>
        </div>
        @if (count($errors) > 0)
            <div class="error_text">
                @foreach ($errors->all() as $error )
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form action="./store" method="post" class="admin_form">
            @csrf
            <div class="text_left">
                <label class="form_label">登録者ニックネーム</label><br/>
                <input type="text" name="name" class="input_text w_250 mb_10" maxlength="10">

                <label class="form_label disp_none">備考(任意)</label>
                <input type="text" name="note" class="input_text w_250 mb_10 disp_none" maxlength="100">

                <label class="form_label">粒子の出てくる場所</label><br/>
                <select name="place" class="w_250 mb_10 select_white_border" id="place_pulldown">
                    @foreach (config("const.explodes.place") as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select><br/>
                <img class="img_100per" id="place_img" src="{{ asset('/assets/images/explode/place/1.png') }}" alt="場所" /><br/>

                <label class="form_label">粒子の速さ</label><br/>
                <select name="speed" class="w_250 mb_10 select_white_border">
                    <option value="5">かなり遅い</option>
                    <!--<option value="10">かなり遅い</option>-->
                    <option value="30">やや遅い</option>
                    <option value="50" selected>普通</option>
                    <option value="70">やや早い</option>
                    <option value="100">かなり早い</option>
                    <!--<option value="100">早さMAX</option>-->
                </select><br/>
                
                <label class="form_label">粒子の量</label><br/>
                <select name="quantity" class="w_250 mb_10 select_white_border">
                    <option value="5">かなり少ない</option>
                    <!--<option value="10">かなり少ない</option>-->
                    <option value="30">やや少ない</option>
                    <option value="50" selected>普通</option>
                    <option value="70">やや多い</option>
                    <option value="90">かなり多い</option>
                    <!--<option value="100">多さMAX</option>-->
                </select><br/>

                <label class="form_label">粒子の大きさ</label><br/>
                <select name="size" class="w_250 mb_10 select_white_border">
                    <option value="10">かなり小さい</option>
                    <option value="20">やや小さい</option>
                    <!--<option value="30">やや小さい</option>-->
                    <option value="30" selected>普通</option>
                    <option value="50">やや大きい</option>
                    <option value="70">かなり大きい</option>
                    <!--<option value="100">大きさMAX</option>-->
                </select><br/>

                <label class="form_label disp_none">粒子の大きさ変化</label>
                <select name="front_bigger" class="w_250 mb_10 disp_none select_white_border">
                    <option value="0">ナシ</option>
                    <option value="1">アリ</option>  
                </select>

                <label class="form_label">粒子の色(最大５色設定可能)</label><br/>
                <input type="number" id="color_num" name="color_num" class="input_text disp_none" max=5 min=1 value=1>
                <button type="button" onclick="display_color_input('plus')">追加</button>
                <button type="button" onclick="display_color_input('minus')">削除</button><br/>
                <div class="mb_10">
                    <input type="color" name="color_1" id="color_1" value="#ffffff">
                    <input type="color" name="color_2" id="color_2" value="#ffffff" class="disp_none">
                    <input type="color" name="color_3" id="color_3" value="#ffffff" class="disp_none">
                    <input type="color" name="color_4" id="color_4" value="#ffffff" class="disp_none">
                    <input type="color" name="color_5" id="color_5" value="#ffffff" class="disp_none">
                </div>

                <label class="form_label">継続秒数</label><br/>
                <input type="number" name="count" class="input_text w_250 mb_10" min="1" max="10" value="5">

                <label class="form_label disp_none">order(optional)</label>
                <input type="number" name="order" class="input_text w_250 mb_10 disp_none" maxlength="100" value={{ $order }}>
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

        document.getElementById("place_pulldown").onchange = function(){
            var place = document.getElementById("place_pulldown");
            var img_path = "{{ asset('/assets/images/explode/place/') }}/" + place.value + ".png";
            $('#place_img').attr('src',img_path);
        };
    </script>
@endsection