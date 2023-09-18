@extends('layout.explode.common',['title'=>'喜びを可視化する/LIST'])
@section('content')
    <div class="text_center">
        <span class="font_size_20">"喜び"の可視化と"喜び"についての対話。</span><br/>
        <span class="font_size_15">喜び可視化システム</span>
    </div>
    <div class="text_center link_text">
        <a href="{{ route('explode_workshop.show', $workshop_id) }}">登録画面へ</a>
    </div>
    
    <table class="elm_center admin_table">
        @foreach ($explodes as $explode)
            @if ($loop->index === 0 || $loop->index % 4 === 0 )<tr/>@endif
            <td class="text_left w_250">
                <a href="{{ route('explode.sample_2023', $explode->id) }}" class="under_line_text font_size_20">{{ $explode->name }}さん</a>
                <div>
                    @php
                        $color_num = explode(",", $explode->colors)
                    @endphp
                    <div class="open_color disp_none">
                        @foreach ($color_num as $color)
                            <font class="honan_color font_size_20" color="{{ $color }}">■</font>
                        @endforeach
                    </div>
                    <div class="open_direction disp_none">
                        <a>{{ config("const.explodes.place")[$explode->place] }}</a>
                    </div>
                </div>
            </td>
        @endforeach
    </table>

    <div class="text_center">
        <a class="link_text" onclick="display_color()">粒子の色</a>
        <a class="link_text" onclick="display_direction()">粒子の方向</a><br/>
        <a class="link_text" onclick="clear_cookie()">色・方向非表示</a>
    </div>

    <script>
        function display_color(){
            $('.open_color').show();
            document.cookie = 'explode_color=1';

            
        }

        function display_direction(){
            $('.open_direction').show();
            document.cookie = 'explode_direction=1';
        }

        window.onload = function(){
            var r = document.cookie.split(';');
            r.forEach(function(value) {
                //cookie名と値に分ける
                var content = value.split('=');
                console.log(content[0]);
                if(content[0].match("explode_color")){
                    display_color();
                }
                if(content[0].match("explode_direction")){
                    display_direction();
                }
            })
        }

        function clear_cookie(){
            document.cookie = 'explode_color=1; max-age=0';
            document.cookie = 'explode_direction=1; max-age=0';
            $('.open_color').hide();
            $('.open_direction').hide();
        }
    </script>

@endsection