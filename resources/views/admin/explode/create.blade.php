@extends("layout.admin.explode.common",["title"=>"NEW"])
@section("content")
    <div class="admin_form_div text_center">
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
                <label class="form_label">title</label><br/>
                <input type="text" name="name" class="input_text w_250 mb_10" maxlength="50"><br/>

                <label class="form_label">note(optional)</label><br/>
                <input type="text" name="note" class="input_text w_250 mb_10" maxlength="100"><br/>

                <label class="form_label">place</label><br/>
                <select name="place" class="w_250 mb_10">
                    @foreach (config("const.explodes.place") as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select><br/>

                <label class="form_label">speed</label><br/>
                <span class="font_size_12">[ex.]slow:1 mid:50 fast:100</span><br/>
                <input type="number" name="speed" class="input_text w_250 mb_10" maxlength="20" value=10><br/>
                
                <label class="form_label">quantity</label><br/>
                <span class="font_size_12">[ex.]little:10 mid:500 many:1000</span><br/>
                <input type="number" name="quantity" class="input_text w_250 mb_10" maxlength="20" value=500><br/>

                <label class="form_label">size</label><br/>
                <span class="font_size_12">[ex.]small:10 mid:100 big:200</span><br/>
                <input type="number" name="size" class="input_text w_250 mb_10" maxlength="20" value=20><br/>

                <label class="form_label">front bigger</label><br/>
                <select name="front_bigger" class="w_250 mb_10">
                    <option value="1">yes</option>
                    <option value="0">no</option>
                </select><br/>

                <label class="form_label">color</label><br/>
                <input type="number" id="color_num" name="color_num" class="input_text" max=5 min=1 value=5>
                <button type="button" onclick="display_color_input()">submit</button><br/>
                <div class="mb_10">
                    <input type="color" name="color_1" id="color_1">
                    <input type="color" name="color_2" id="color_2">
                    <input type="color" name="color_3" id="color_3">
                    <input type="color" name="color_4" id="color_4">
                    <input type="color" name="color_5" id="color_5">
                </div>

                <label class="form_label">count</label><br/>
                <input type="number" name="count" class="input_text w_250 mb_10" maxlength="20" value=4><br/>

                <label class="form_label">order(optional)</label><br/>
                <input type="number" name="order" class="input_text w_250 mb_10" maxlength="100" value=1><br/>
            </div>
            <input type="submit" class="main_button" value="submit">
        </form>
    </div>

    <script>
        function display_color_input(){
            var org_color_num = $('#color_num').val(); //色数取得
            var color_num = parseInt(org_color_num); //数値変換
            if(isNaN(color_num)) color_num = 1; //数値でなければ1にする
            if(color_num < 1) color_num = 1; //0以下なら1にする
            if(color_num > 5) color_num = 5; //6以上なら5にする
            //入力フォーム表示設定
            for(var i=1; i<=5; i++){
                if(color_num < i){
                    $('#color_'+i).hide();
                }else{
                    $('#color_'+i).show();
                }                
            }
        }
    </script>
@endsection