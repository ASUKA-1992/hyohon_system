@extends("layout.admin.explode.common",["title"=>"EDIT"])
@section("content")
    <div class="admin_form_div text_center">
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="{{ route('explode.update', ['id'=>$explode->id]) }}" method="post" class="admin_form">
            @csrf
            @method('patch')
            <div class="text_left">
                <label class="form_label">title</label><br/>
                <input type="text" name="name" class="input_text w_250 mb_10" maxlength="50"
                    value="{{old('name') ?? $explode->name}}"><br/>

                <label class="form_label">note(optional)</label><br/>
                <input type="text" name="note" class="input_text w_250 mb_10" maxlength="100"
                    value="{{old('note') ?? $explode->note}}"><br/>

                <label class="form_label">place</label><br/>
                <select name="place" class="w_250 mb_10">
                    @foreach (config("const.explodes.place") as $key => $value)
                        @if($explode->place == $key)
                            <option value="{{ $key }}" selected="selected">{{ $value }}</option>
                        @else
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endif
                    @endforeach
                </select><br/>

                <label class="form_label">speed</label><br/>
                <span class="font_size_12">[ex.]slow:1 mid:50 fast:100</span><br/>
                <input type="number" name="speed" class="input_text w_250 mb_10" maxlength="20"
                    value="{{old('speed') ?? $explode->speed}}"><br/>

                <label class="form_label">quantity</label><br/>
                <span class="font_size_12">[ex.]little:10 mid:500 many:1000</span><br/>
                <input type="number" name="quantity" class="input_text w_250 mb_10" maxlength="20"
                    value="{{old('quantity') ?? $explode->quantity}}"><br/>

                <label class="form_label">size</label><br/>
                <span class="font_size_12">[ex.]small:10 mid:100 big:200</span><br/>
                <input type="number" name="size" class="input_text w_250 mb_10" maxlength="20"
                    value="{{old('size') ?? $explode->size}}"><br/>

                <label class="form_label">front bigger</label><br/>
                <select name="front_bigger" class="w_250 mb_10">
                    <option value="1" {{ ($explode->front_bigger == 1) ? 'selected=selected' : ''}}>yes</option>
                    <option value="0" {{ ($explode->front_bigger == 0) ? 'selected' : ''}}>no</option>
                </select><br/>

                <label class="form_label">color</label><br/>
                <input type="number" id="color_num" name="color_num" class="input_text" max=5 min=1 
                    value="{{ count($color_num) }}">
                <button type="button" onclick="display_color_input()">submit</button><br/>
                <div class="mb_10">
                    <input type="color" name="color_1" id="color_1"
                        value="{{ $color_num[0] }}">
                    <input type="color" name="color_2" id="color_2"
                        value="{{ isset($color_num[1]) ? $color_num[1] : '' }}"
                        class="{{ isset($color_num[1]) ? '' : 'disp_none' }}">
                    <input type="color" name="color_3" id="color_3"
                        value="{{ isset($color_num[2]) ? $color_num[2] : '' }}"
                        class="{{ isset($color_num[2]) ? '' : 'disp_none' }}">
                    <input type="color" name="color_4" id="color_4"
                        value="{{ isset($color_num[3]) ? $color_num[3] : '' }}"
                        class="{{ isset($color_num[3]) ? '' : 'disp_none' }}">
                    <input type="color" name="color_5" id="color_5"
                        value="{{ isset($color_num[4]) ? $color_num[4] : '' }}"
                        class="{{ isset($color_num[4]) ? '' : 'disp_none' }}">
                </div>
                
                <label class="form_label">count</label><br/>
                <input type="number" name="count" class="input_text w_250 mb_10" maxlength="20"
                value="{{old('count') ?? $explode->count}}"><br/>

                <label class="form_label">order(optional)</label><br/>
                <input type="number" name="order" class="input_text w_250 mb_10" maxlength="100"
                    value="{{old('order') ?? $explode->order}}"><br/>
                    
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