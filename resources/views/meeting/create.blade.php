@extends("layout.common",["title"=>"会議作成"])
@section("content")
    <div class="text_center meeting_create">
        @if (count($errors) > 0)
            <div class="error_text">
                @foreach ($errors->all() as $error )
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        
        <form action="./store" method="post" class="admin_form">
            @csrf
            <label class="form_label">{{ config("const.label.meeting_name") }}</label><br/>
            <input type="text" name="name" class="input_text" value="{{ old('name') }}" maxlength="50"><br/>

            <label class="form_label">{{ config("const.label.meeting_title") }}</label><br/>
            <input type="text" name="title" id="theme_title" class="input_text" value="{{ old('title') }}" maxlength="50"><br/>
            <span onclick="show_select_theme();" class="min_button">登録されているテーマから選択する</span><br/>

            <label class="form_label">{{ config("const.label.tag") }}(任意)</label><br/>
            <input type="text" name="tag" class="input_text" value="{{ old('tag') }}" maxlength="100"><br/>
            
            <label class="form_label">{{ config("const.label.owner") }}</label><br/>
            <input type="text" name="owner" id="owner" class="input_text" value="{{ old('owner') }}" maxlength="10"><br/>
            
            <label class="form_label">参加者数</label><br/>
            <input type="number" id="participants_num" name="participants_num" class="input_text" max=20 min=2 value=5><br/>

            <label class="form_label">{{ config("const.label.role") }} 
                <span class="font_size_12">(
                    <span class="under_line_text" onclick="select_all_role()">全選択</span> / 
                    <span class="under_line_text" onclick="unselect_all_role()">全解除</span>
                )</span>
            </label><br/>
            <span class="font_size_12">官:民:フリー=1:2:1。スペシャルは1名まで。</span>
            <div class="font_size_15">
                <span id="role_select_num">0</span>/<span id="role_base_num">5</span>
            </div>
            <table class="elm_center admin_table">
                @foreach ($roles as $role)
                    <tr class="active_row_{{ $role->active_flg }}">
                        <td>
                            <input type="checkbox" class="role_checkbox" id="role_{{ $role->id }}" name="role[]" value="{{ $role->id }}"
                                @if(is_array(old('role')) && in_array($role->id, old('role'))) checked @endif />
                        </td>
                        <td class="w_150">{{ $role->name }}</td>
                        <td class="w_150">{{ config("const.roles.name_sub")[$role->name_sub] }}</td>
                    </tr>
                @endforeach
            </table>

            <label class="form_label">{{ config("const.label.action") }} 
                <span class="font_size_12">(
                    <span class="under_line_text" onclick="select_all_action()">全選択</span> / 
                    <span class="under_line_text" onclick="unselect_all_action()">全解除</span>
                )</span>
            </label><br/>
            <div class="font_size_15"><span id="action_select_num">0</span>/<span id="action_base_num">5</span></div>
            <table class="elm_center admin_table">
                @foreach ($actions as $action)
                    <tr class="active_row_{{ $action->active_flg }}">
                        <td>
                            <input type="checkbox" class="action_checkbox" id="action_{{ $action->id }}" name="action[]" value="{{ $action->id }}"
                                @if(is_array(old('action')) && in_array($action->id, old('action'))) checked @endif />
                        </td>
                        <td class="w_150">{{ $action->name }}</td>
                        <td class="w_150">{{ config("const.actions.name_sub")[$action->name_sub] }}</td>
                    </tr>
                @endforeach
            </table>

            <input type="submit" id="submit_btn" class="main_button main_button_disabled" value="登録" disabled>
        </form>

        <div class="overlay" id="popup">
            <div class="window">
                <a class="close" onclick="close_select_theme();">×</a>
                <ul>
                    @foreach ($themes as $theme)
                        <li>
                            <a onclick="select_theme(this);" class="wide_button">{{ $theme->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        function show_select_theme(){
            $('#popup').show();
        }

        function select_theme(e){
            $('#theme_title').val(e.text);
            $('#popup').hide();
        }

        function close_select_theme(){
            $('#popup').hide();
        }

        window.onload = function () {
            checkbox_disp_btn();
            var role_checkbox = document.getElementsByClassName("role_checkbox");
            var action_checkbox = document.getElementsByClassName("action_checkbox");

            // 役割チェック
            for( var i = 0; i < role_checkbox.length; i++ ) {
                role_checkbox[i].onclick = function () {
                    checkbox_disp_btn();
                }   
            }

            // アクションチェック
            for( var i = 0; i < action_checkbox.length; i++ ) {
                action_checkbox[i].onclick = function () {
                    checkbox_disp_btn();
                }   
            }

            // ファシリテーター名が空の場合、ランダムで文字列を入れる
            var owner = $('#owner').val();
            if(owner == ""){
                owner_names = ["わた", "綿貫さん", "名無しのファシリ"];
                var owner_name = owner_names[Math.floor(Math.random() * owner_names.length)];
                $('#owner').val(owner_name);
            }
        }

        function checkbox_disp_btn(){
            var role_checkbox = document.getElementsByClassName("role_checkbox");
            var action_checkbox = document.getElementsByClassName("action_checkbox");

            // 参加者数取得
            var participants_num = $('#participants_num').val();

            // 役割チェック数取得
            var role_checkbox_count = 0;
            for (let i2 = 0; i2 < role_checkbox.length; i2++) {
                if (role_checkbox[i2].checked) {
                    role_checkbox_count++;
                }
            }

            // アクションチェック数取得
            var action_checkbox_count = 0;
            for (let i3 = 0; i3 < action_checkbox.length; i3++) {
                if (action_checkbox[i3].checked) {
                    action_checkbox_count++;
                }
            }

            if(participants_num <= role_checkbox_count && participants_num <= action_checkbox_count){
                $('#submit_btn').prop('disabled', false);
                $('#submit_btn').removeClass("main_button_disabled");                
            } else {
                $('#submit_btn').prop('disabled', true);
                $('#submit_btn').removeClass("main_button_disabled"); //重複避けるため一度クラス削除
                $('#submit_btn').addClass("main_button_disabled");
            }

            //役割とアクションのカウント
            $('#role_base_num').html(participants_num);
            $('#action_base_num').html(participants_num);
            $('#role_select_num').html(role_checkbox_count);
            $('#action_select_num').html(action_checkbox_count);
        }

        function select_all_role(){
            $('.role_checkbox').prop( 'checked', true );
            checkbox_disp_btn();
        }

        function unselect_all_role(){
            $('.role_checkbox').prop( 'checked', false );
            checkbox_disp_btn();
        }

        function select_all_action(){
            $('.action_checkbox').prop( 'checked', true );
            checkbox_disp_btn();
        }

        function unselect_all_action(){
            $('.action_checkbox').prop( 'checked', false );
            checkbox_disp_btn();
        }
    </script>
@endsection