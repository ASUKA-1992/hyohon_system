@extends('layout.explode.show')
@section('content')
<div class="text_center disp_none">
    <input value="{{ $explode->name }}"/>
    <input id ="place" value="{{ $explode->place }}"/>
    <input id ="speed" value="{{ $explode->speed }}"/>
    <input id ="quantity" value="{{ $explode->quantity }}"/>
    <input id ="size" value="{{ $explode->size }}"/>
    <input id ="colors" value="{{ $explode->colors }}"/>
</div>

<div class="text_center disp_none">
    <div class="font_size_20 bold mt_10">{{ $explode->name }}</div>
    <div>{{ $explode->note }}</div>
</div>

<div id="bottom_btn_div" class="disp_none">
    <a class="under_line_text" href="{{ route('explode.index') }}">list</a>/
    @if(isset($previous)) <a class="under_line_text" href="{{ route('explode.show', $previous) }}">before</a>@endif
    @if(isset($previous) && isset($next)) / @endif
    @if(isset($next)) <a class="under_line_text" href="{{ route('explode.show', $next) }}">next</a> @endif
</div>

<div id="canvas_area">    
</div>

<div id="explode_border">
</div>

<script>
    // 準備ここから
    var dirs = [];
    var parts = [];
    var container = document.createElement('div');
    container.id = "explode_main_div"; 
    var canvas_area = document.getElementById("canvas_area");
    canvas_area.appendChild( container );

    var renderer = new THREE.WebGLRenderer();
    //renderer.setSize(window.innerWidth * 0.35, window.innerHeight * 0.80);
    renderer.setSize(window.innerWidth * 0.95, window.innerHeight * 0.95);
    container.appendChild( renderer.domElement );

    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight,1, 10000)
    camera.position.z = 1000; 

    var scene = new THREE.Scene(); 
    renderer.render( scene, camera );
    render();
    // 準備ここまで

    // レンダー処理
    function render() {
        requestAnimationFrame( render );
        var pCount = parts.length;
        while(pCount--) {
            parts[pCount].update();
        }
        renderer.render( scene, camera );
    }

    //クリック
    const el = document.getElementById('explode_border');
    el.addEventListener('click', function(){
        main();
    }, false);

    // 指定秒数分止める
    const sleep = (second) => new Promise(resolve => setTimeout(resolve, second * 1000));

    async function main(){
        //粒子発生数
        var count = {{ $explode->count }};

        // 発生のカウントアップ
        let count_up = 0;
        const countUp = () =>{
            console.log(count_up++);
        }

        const intervalId = setInterval(() =>{
            countUp();
            //発生処理
            parts.push(new ExplodeAnimation());
            if(count_up >= count){
                clearInterval(intervalId);
        }}, 100);
    }

    function ExplodeAnimation(){
        //タイプから粒子の条件を取得
        var movementSpeed = {{ $explode->speed }};
        var totalObjects = {{ $explode->quantity }};
        var objectSize = {{ $explode->size }};
        var sizeRandomness = 4000;
        //粒子発生場所番号
        var place_num = {{ $explode->place }};
        var place = places[place_num];
        //場所がランダム
        var random_palace = {{ $explode->place == 5 ? 1 : 0 }};
        //粒子巨大化
        var front_bigger = {{ $explode->front_bigger }};
        //粒子の色
        var colors = [{{ $colors }}];

        //xとy
        if(place.length == 1){
            var x = place[0][0];
            var y = place[0][1];
        } else {
            selected_place = place[Math.floor(Math.random() * place.length)];
            var x = selected_place[0];
            var y = selected_place[1];
        }

        var geometry = new THREE.Geometry();
        
        for (i = 0; i < totalObjects; i ++){
            var vertex = new THREE.Vector3();
            vertex.z = 0;
            
            // ランダムな場所
            if(random_palace){
                vertex.x = (Math.random() * sizeRandomness)-(sizeRandomness/2);
                vertex.y = (Math.random() * sizeRandomness)-(sizeRandomness/2);

            } else {
                // 同じ場所から出てくる
                vertex.x = x;
                vertex.y = y;
            }
            geometry.vertices.push( vertex );

            
            x_dir = (Math.random() * movementSpeed)-(movementSpeed/2);
            y_dir = (Math.random() * movementSpeed)-(movementSpeed/2);
            //粒子巨大化
            if(front_bigger){
                z_dir = (Math.random() * movementSpeed)-(movementSpeed/2);
            }else{
                z_dir = 0;
            }

            if(i != 0){
                if(i % 2 == 0 ) {
                    //x_dir = x_dir + 0.05;
                } else {
                    //x_dir = x_dir - 0.05;
                }
            }
            
            dirs.push({x:x_dir,y:y_dir,z:z_dir});
        }

        //色設定
        color = colors[Math.round(Math.random() * colors.length)];
        if(color === undefined){
            color = colors[0];
        }
        
        var material = new THREE.ParticleBasicMaterial( { size: objectSize,  color: color, fog: true });
        //material.linecap = 'round'
        var particles = new THREE.ParticleSystem( geometry, material );
        
        this.object = particles;
        this.status = true;
        
        scene.add( this.object ); 
        
        this.update = function(){
            if (this.status == true){
            var pCount = totalObjects;
            while(pCount--) {
                var particle =  this.object.geometry.vertices[pCount]
                particle.y += dirs[pCount].y;
                particle.x += dirs[pCount].x;
                particle.z += dirs[pCount].z;
            }
            this.object.geometry.verticesNeedUpdate = true;
            }
        }
    }

    // 発生場所定義
    places = {
        1: [[0, 0]],
        2: [[0, 800]],
        3: [[0, -800]],
        4: [[1700, 800], [1700, -800], [-1700, 800], [-1700, -800]],
        5: [[0, 0]],
	};
</script>

@endsection