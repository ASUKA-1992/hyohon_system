@extends("layout.admin.common",["title"=>"会議作成"])
@section("content")
    <div class="text_center">
        @if($errors->has("name"))
            <div class="error_text">{{ $errors->first("name") }}</div>
        @endif
        <form action="./store" method="post" class="admin_form">
            @csrf
            <label>会議名</label>
            <input type="text" name="title" id="theme_title" class="input_text w_250 mb_10" maxlength="50"><br/>
            <a>登録されているテーマから選択する</a><br/>
            
            <label>オーナー名</label>
            <input type="text" name="owner" id="owner_name" class="input_text w_250 mb_10" maxlength="10"><br/>
            <span>オーナーも会議に参加する</span><input type="checkbox" name="owner_join_flg" id="owner_join_flg"><br/>
            
            <label>参加者数</label>
            <input type="number" id="participants_num" name="participants_num" class="input_text w_250 mb_10" max=10 min=2 value=2><br/>

            <button type="button" onclick="display_paticipant_input()">参加者入力</button><br/>
            
            <label>参加者名</label>
            @for($i = 1; $i <= 10; $i++)
                <span id="label_participant_{{ $i }}">{{ $i }}</span>
                <input type="text" name="participant_{{ $i }}" id="participant_{{ $i }}" class="input_text w_250 mb_10 " maxlength="10"><br/>
            @endfor

            <label>役割</label>
            <table class="elm_center admin_table">
            @foreach ($roles as $role)
                <tr class="active_row_{{ $role->active_flg }}">
                    <td><input type="checkbox" id="role_{{ $role->id }}" name="role[]" checked="checked" value="{{ $role->id }}"></td>
                    <td>{{ $role->name }}</td>
                    <td>{{ config("const.roles.name_sub")[$role->name_sub] }}</td>
            </tr>
            @endforeach
            </table>

            <label>アクション</label>
            <table class="elm_center admin_table">
            @foreach ($actions as $action)
                <tr class="active_row_{{ $action->active_flg }}">
                    <td><input type="checkbox" id="action_{{ $action->id }}" name="action[]" checked="checked" value="{{ $action->id }}"></td>
                    <td>{{ $action->name }}</td>
                    <td>{{ config("const.actions.name_sub")[$action->name_sub] }}</td>
                </tr>
            @endforeach
            </table>

            <input type="submit" value="登録">
        </form>

        <div>
        @foreach ($themes as $theme)
            <a onclick="select_theme(this);">{{ $theme->name }}</a>
        @endforeach
        </div>
    </div>

    <script>
        function display_paticipant_input(){
            var org_participants_num = $('#participants_num').val(); //参加人数取得
            participants_num = parseInt(org_participants_num); //数値変換
            if(isNaN(participants_num)) participants_num = 2; //数値でなければ2にする
            if(participants_num < 2) participants_num = 2; //1以下なら2にする
            if(participants_num > 10) participants_num = 10; //11以上なら10にする

            //入力フォーム表示設定
            for(var i=1; i<=10; i++){
                if(participants_num < i){
                    $('#label_participant_'+i).hide();
                    $('#participant_'+i).val('');
                    $('#participant_'+i).hide();
                }else{
                    $('#label_participant_'+i).show();
                    $('#participant_'+i).show();
                }                
            }

            //オーナーが参加する場合、参加者入力フォーム先頭を、オーナー名とする
            var owner_name = $('#owner_name').val();
            if($('input[name=owner_join_flg]').prop("checked") && owner_name != ""){   
                $('#participant_1').val(owner_name);
                $('#participant_1').attr('readonly',true);
            } else {
                $('#participant_1').attr('readonly',false);
            }
        }

        function select_theme(e){
            $('#theme_title').val(e.text);
        }
    </script>
@endsection