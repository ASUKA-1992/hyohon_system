@extends('layout.explode.sample_2023')
@section('content')
<div class="text_center disp_none">
    <input value="{{ $explode->name }}"/>
    <input id ="place" value="{{ $explode->place }}"/>
    <input id ="speed" value="{{ $explode->speed }}"/>
    <input id ="quantity" value="{{ $explode->quantity }}"/>
    <input id ="size" value="{{ $explode->size }}"/>
    <input id ="colors" value="{{ $explode->colors }}"/>
</div>

<div>
	<div id="ThreeJS" style="position: absolute; left:0px; top:0px"></div>
	<div id="title_area">
		@if(!is_null($login_admin))
			<a class="link_text" href="../explode_honban">投影用一覧画面へ</a>
		@else
			<a class="link_text" href="../explode">トップ画面へ</a>
		@endif
		<div class="font_size_30">{{ $explode->name }}さん</div>
		<div class="font_size_25 bold disp_none">{{ $explode->note }}</div>
	</div>
</div>
<script>
/*
	Three.js "tutorials by example"
	Author: Lee Stemkoski
	Date: July 2013 (three.js v59dev)
*/

Examples =
{
	// (1) build GUI for easy effects access.
	// (2) write ParticleEngineExamples.js
	
	// Not just any fountain -- a RAINBOW STAR FOUNTAIN of AWESOMENESS
	fountain :
	{
		name             : "fountain",
		positionStyle    : Type.CUBE,
		positionBase     : new THREE.Vector3( 0,  5, 0 ),
		positionSpread   : new THREE.Vector3( 10, 10, 10 ),
		
		velocityBase     : new THREE.Vector3( 0, -60, 0 ),//Y: スピード小さいほど早い
		velocitySpread   : new THREE.Vector3( 50, 20, 50 ), 
		accelerationBase : new THREE.Vector3( 0, -10,0 ),

		accelerationBase : new THREE.Vector3( 0, -100, 0 ),
		
		particleTexture : THREE.ImageUtils.loadTexture( 'images/spikey.png' ),

		angleBase               : 0,
		angleSpread             : 180,
		angleVelocityBase       : 0,
		angleVelocitySpread     : 360 * 4,
		
		sizeTween    : new Tween( [0, 1], [1, 20] ),
		opacityTween : new Tween( [2, 3], [1, 0] ),
		colorTween   : new Tween( [0.5, 2], [ new THREE.Vector3(0,1,0.5), new THREE.Vector3(0.8, 1, 0.5) ] ),
		selectedColor : colors(),

		particlesPerSecond : 200,
		particleDeathAge   : 3.0,		
		emitterDeathAge    : 60,

		front_bigger: selected_front_bigger()
	},

	snow :
	{
		name             : "snow",
		positionStyle    : Type.CUBE,
		positionBase     : new THREE.Vector3( 0, 200, 0 ),
		positionSpread   : new THREE.Vector3( 500, 0, 500 ),
		
		velocityStyle    : Type.CUBE,
		velocityBase     : new THREE.Vector3( 0, -60, 0 ),//Y: スピード小さいほど早い
		velocitySpread   : new THREE.Vector3( selected_speed(), selected_speed(), selected_speed() ), 
		accelerationBase : new THREE.Vector3( 0, -10,0 ),
		
		particleTexture : THREE.ImageUtils.loadTexture( 'images/spikey.png' ),
			
		sizeBase    : selected_size(),
		//sizeTween    : new Tween( [0, 0.25], [1, 10] ),
		colorBase   : new THREE.Vector3(0.66, 1.0, 0.9), // H,S,L
		selectedColor : colors(),
		//opacityTween : new Tween( [2, 3], [0.8, 0] ),

		particlesPerSecond : selected_quantity(),
		particleDeathAge   : selected_count(),	
		emitterDeathAge    : selected_count(),

		front_bigger: selected_front_bigger()
	},

	snow_reverse :
	{
		name             : "snow_reverse",
		positionStyle    : Type.CUBE,
		positionBase     : new THREE.Vector3( 0, -370, 0 ),
		positionSpread   : new THREE.Vector3( 500, 0, 500 ),
		
		velocityStyle    : Type.CUBE,
		velocityBase     : new THREE.Vector3( 0, -60, 0 ),//Y: スピード小さいほど早い
		velocitySpread   : new THREE.Vector3( selected_speed(), selected_speed(), selected_speed() ), 
		accelerationBase : new THREE.Vector3( 0, -10,0 ),

		angleBase               : 0,
		angleVelocitySpread     : 0,
		
		particleTexture : THREE.ImageUtils.loadTexture( 'images/spikey.png' ),
			
		sizeBase    : selected_size(),
		//sizeTween    : new Tween( [0, 0.25], [1, 10] ),
		colorBase   : new THREE.Vector3(0.66, 1.0, 0.9), // H,S,L
		selectedColor : colors(),
		//opacityTween : new Tween( [2, 3], [0.8, 0] ),

		particlesPerSecond : selected_quantity(),
		particleDeathAge   : selected_count(),	
		emitterDeathAge    : selected_count(),

		front_bigger: selected_front_bigger()
	},
	
	rain :
	{
		name             : "rain",
		positionStyle    : Type.CUBE,
		positionBase     : new THREE.Vector3( 0, 200, 0 ),
		positionSpread   : new THREE.Vector3( 500, 10, 10 ),
		//positionSpread   : new THREE.Vector3( 10, 10, 10 ),
		velocityStyle    : Type.CUBE,
		velocityBase     : new THREE.Vector3( 0, selected_speed() * -1, 0 ), //Y:方向
		velocitySpread   : new THREE.Vector3( 10, 50, 10 ), 
		accelerationBase : new THREE.Vector3( 0, -10,0 ),
		
		particleTexture : THREE.ImageUtils.loadTexture( 'images/spikey.png' ),

		sizeBase    : selected_size(),
		//sizeSpread  : 4.0,
		colorBase   : new THREE.Vector3(0.66, 1.0, 0.7), // H,S,L
		selectedColor : colors(),
		colorSpread : new THREE.Vector3(0.00, 0.0, 0.2),

		particlesPerSecond : selected_quantity(),
		particleDeathAge   : selected_count(),	
		emitterDeathAge    : selected_count(),

		front_bigger: selected_front_bigger()
	},

	rain_reverse :
	{
		name             : "rain_reverse",
		positionStyle    : Type.CUBE,
		positionBase     : new THREE.Vector3( 0, -370, 0 ),
		positionSpread   : new THREE.Vector3( 500, 10, 10 ),
		//positionSpread   : new THREE.Vector3( 10, 10, 10 ),
		velocityStyle    : Type.CUBE,
		velocityBase     : new THREE.Vector3( 0, selected_speed(), 0 ), //Y:方向
		velocitySpread   : new THREE.Vector3( 10, 50, 10 ), 
		accelerationBase : new THREE.Vector3( 0, -10,0 ),
		
		particleTexture : THREE.ImageUtils.loadTexture( 'images/spikey.png' ),

		sizeBase    : selected_size(),
		//sizeSpread  : 4.0,
		colorBase   : new THREE.Vector3(0.66, 1.0, 0.7), // H,S,L
		selectedColor : colors(),
		colorSpread : new THREE.Vector3(0.00, 0.0, 0.2),

		particlesPerSecond : selected_quantity(),
		particleDeathAge   : selected_count(),	
		emitterDeathAge    : selected_count(),

		front_bigger: selected_front_bigger()
	},

	fireflies :
	{
		name             : "fireflies",
		positionStyle  : Type.CUBE,
		positionBase   : new THREE.Vector3( 0, 100, 0 ),
		positionSpread : new THREE.Vector3( 10, 10, 10 ),

		velocityStyle  : Type.CUBE,
		velocityBase   : new THREE.Vector3( 0, 0, 0 ),
		velocitySpread : new THREE.Vector3( 60, 20, 60 ), 
		
		particleTexture : THREE.ImageUtils.loadTexture( 'images/spikey.png' ),

		sizeBase   : 30.0,
		sizeSpread : 2.0,
		//opacityTween : new Tween([0.0, 1.0, 1.1, 2.0, 2.1, 3.0, 3.1, 4.0, 4.1, 5.0, 5.1, 6.0, 6.1],
		//                        [0.2, 0.2, 1.0, 1.0, 0.2, 0.2, 1.0, 1.0, 0.2, 0.2, 1.0, 1.0, 0.2] ),				
		colorBase   : new THREE.Vector3(0.30, 1.0, 0.6), // H,S,L
		selectedColor : colors(),
		//colorSpread : new THREE.Vector3(0.3, 0.0, 0.0),

		particlesPerSecond : 20,
		particleDeathAge   : 6.1,		
		emitterDeathAge    : 600,

		front_bigger: selected_front_bigger()
	},
	
	/*基本形*/
	startunnel :
	{
		name             : "startunnel",
		positionStyle  : Type.CUBE,
		positionBase   : startunnel_place(),
		positionSpread : new THREE.Vector3( 10, 10, 10 ),

		positionStyle  : Type.CUBE,
		velocityBase     : new THREE.Vector3( 0, 0, 0 ),	
		velocitySpread   : new THREE.Vector3( selected_speed(), selected_speed(), selected_speed() ), 

		accelerationBase : new THREE.Vector3( 0, 0, 0 ),
		
		angleBase               : 0,
		angleVelocitySpread     : 0,
		
		particleTexture : THREE.ImageUtils.loadTexture( 'images/spikey.png' ),

		sizeBase    : selected_size(),
		sizeSpread  : 4,				
		colorBase   : new THREE.Vector3(0.15, 1.0, 0.8), // H,S,L
		selectedColor : colors(),
		opacityBase : 1,

		particlesPerSecond : selected_quantity(), //1秒の粒子の量
		particleDeathAge   : selected_count(),	
		emitterDeathAge    : selected_count(),

		front_bigger: selected_front_bigger()
	}
	
}

// MAIN

// standard global variables
var container, scene, camera, renderer, controls, stats;
var keyboard = new THREEx.KeyboardState();
var clock = new THREE.Clock();
// custom global variables
var cube;

init();
animate();

function colors(){
	return [{{ $colors }}];
}

function selected_size(){
	if (navigator.userAgent.match(/iPhone|Android.+Mobile/)) {
		return [{{ $explode->size * 0.7}}];
	}else{
		return [{{ $explode->size * 0.2}}];
	}
}

function selected_speed(){
	var speed = {{ $explode->speed * 20 }};
	return speed; 
}

function selected_front_bigger(){
	return {{ $explode->front_bigger }};
}

function selected_quantity(){
	//中央から出る場合、量を少なくする
	selected_place = {{ $explode->place }};
	if(selected_place == 1){
		return {{ $explode->quantity * 7 }};
	}
	return {{ $explode->quantity * 15 }};
}

function selected_count(){
	return {{ $explode->count / 2 }};
}

function explode_seconds(){
	return {{ $explode->count }} + 5; 
}

function startunnel_place(){
	selected_place = {{ $explode->place }};
	switch (selected_place) {
		case 2:
			ret = new THREE.Vector3( 0, 200, 0 );
			break;
		case 3:
			ret = new THREE.Vector3( 0, -240, 0 );
			break;
		case 4:
			if(navigator.userAgent.match(/(iPhone|iPod|Android.*Mobile)/i)){
				ret1 = new THREE.Vector3( 100, 170, 0 ); //右上
				ret2 = new THREE.Vector3( 130, -230, 0 ); 
				ret3 = new THREE.Vector3( -100, 170, 0 ); //左上
				ret4 = new THREE.Vector3( -130, -230, 0 );
			}else{
				ret1 = new THREE.Vector3( 300, 200, 0 ); //右上
				ret2 = new THREE.Vector3( 520, -240, 0 ); 
				ret3 = new THREE.Vector3( -300, 200, 0 ); //左上
				ret4 = new THREE.Vector3( -520, -240, 0 );
			}
			ret = [ret1, ret2, ret3, ret4];
			break;
		default:
			ret1 = new THREE.Vector3( 5, 0, 0 );
			ret2 = new THREE.Vector3( 0, 5, 0 );
			ret3 = new THREE.Vector3( -5, 0, 0 );
			ret4 = new THREE.Vector3( 0, -5, 0 );
			ret = [ret1, ret2, ret3, ret4];
	}
	return ret;
}

// FUNCTIONS 		
function init() 
{
	// SCENE
	scene = new THREE.Scene();
	// CAMERA
	var SCREEN_WIDTH = window.innerWidth, SCREEN_HEIGHT = window.innerHeight;
	var VIEW_ANGLE = 45, ASPECT = SCREEN_WIDTH / SCREEN_HEIGHT, NEAR = 2, FAR = 5000;
	camera = new THREE.PerspectiveCamera( VIEW_ANGLE, ASPECT, NEAR, FAR);
	scene.add(camera);
	camera.position.set(0,200,400);
	camera.lookAt(scene.position);	
	// RENDERER
	if ( Detector.webgl )
		renderer = new THREE.WebGLRenderer( {antialias:true} );
	else
		renderer = new THREE.CanvasRenderer(); 
	renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT -5);
	container = document.getElementById( 'ThreeJS' );
	container.appendChild( renderer.domElement );
	// EVENTS
	THREEx.WindowResize(renderer, camera);
	THREEx.FullScreen.bindKey({ charCode : 'm'.charCodeAt(0) });
	// CONTROLS
	controls = new THREE.OrbitControls( camera, renderer.domElement );
	// STATS
	stats = new Stats();
	stats.domElement.style.position = 'absolute';
	stats.domElement.style.bottom = '0px';
	stats.domElement.style.zIndex = 100;
	//container.appendChild( stats.domElement );
	// LIGHT
	var light = new THREE.PointLight(0xffffff);
	light.position.set(0,250,0);
	scene.add(light);
	// FLOOR
    /* 背景をコメントアウト
	var floorTexture = new THREE.ImageUtils.loadTexture( 'images/checkerboard.jpg' );
	floorTexture.wrapS = floorTexture.wrapT = THREE.RepeatWrapping; 
	floorTexture.repeat.set( 10, 10 );
	var floorMaterial = new THREE.MeshBasicMaterial( { color: 0x444444, side: THREE.DoubleSide } );
	var floorGeometry = new THREE.PlaneGeometry(1000, 1000, 10, 10);
	var floor = new THREE.Mesh(floorGeometry, floorMaterial);
	floor.position.y = -10.5;
	floor.rotation.x = Math.PI / 2;
	scene.add(floor);*/
	// SKYBOX/FOG
	var skyBoxGeometry = new THREE.CubeGeometry( 4000, 4000, 4000 );
	var skyBoxMaterial = new THREE.MeshBasicMaterial( { color: 0x000000, side: THREE.BackSide } );
	var skyBox = new THREE.Mesh( skyBoxGeometry, skyBoxMaterial );
    scene.add(skyBox);
	
	////////////
	// CUSTOM //
	////////////

	
	this.engine = new ParticleEngine();
	switch ({{ $explode->place }}) {
		case 5:
			engine.setValues( Examples.rain );
			break;
		case 6:
			engine.setValues( Examples.snow );
			break;
		case 7:
			engine.setValues( Examples.snow_reverse );
			break;
		case 8:
			engine.setValues( Examples.rain_reverse );
			break;
		default:
			engine.setValues( Examples.startunnel );
	}
	
	engine.initialize();

	//クリック
    const el = document.getElementById('ThreeJS');
    el.addEventListener('click', function(){
		switch ({{ $explode->place }}) {
			case 5:
				restartEngine( Examples.rain );
				break;
			case 6:
				restartEngine( Examples.snow );
				break;
			case 7:
				restartEngine( Examples.snow_reverse );
				break;
			case 8:
				restartEngine( Examples.rain_reverse );
				break;
			default:
				restartEngine( Examples.startunnel );
		}
	}, false);
	
	// GUI for experimenting with parameters

	/*gui = new dat.GUI();	
	parameters = 
	{
		fountain:   function() { restartEngine( Examples.fountain   ); },
		startunnel: function() { restartEngine( Examples.startunnel ); },		
		fireflies:  function() { restartEngine( Examples.fireflies  ); },	
		rain:       function() { restartEngine( Examples.rain       ); },	
		snow:       function() { restartEngine( Examples.snow       ); },
		snow_reverse: function() { restartEngine( Examples.snow_reverse); },
		rain_reverse: function() { restartEngine( Examples.rain_reverse); },
	};

	gui.add( parameters, 'fountain'   ).name("Star Fountain");
	gui.add( parameters, 'startunnel' ).name("Star Tunnel");
	gui.add( parameters, 'fireflies'  ).name("Fireflies");
	gui.add( parameters, 'rain'       ).name("Rain");
	gui.add( parameters, 'snow'       ).name("Snow");
	gui.add( parameters, 'snow_reverse' ).name("Snow Reverse");
	gui.add( parameters, 'rain_reverse' ).name("Rain Reverse");
	
	gui.open();*/
}

function animate() 
{
    requestAnimationFrame( animate );
	update();
	render();
}

function restartEngine(parameters)
{
	resetCamera();
	
	engine.destroy();
	engine = new ParticleEngine();
	engine.setValues( parameters );
	engine.initialize();
}

function resetCamera()
{
	// CAMERA
	var SCREEN_WIDTH = window.innerWidth, SCREEN_HEIGHT = window.innerHeight;
	var VIEW_ANGLE = 45, ASPECT = SCREEN_WIDTH / SCREEN_HEIGHT, NEAR = 0.1, FAR = 20000;
	camera = new THREE.PerspectiveCamera( VIEW_ANGLE, ASPECT, NEAR, FAR);
	//camera.up = new THREE.Vector3( 0, 0, 1 );
	camera.position.set(0,200,400);
	camera.lookAt(scene.position);	
	scene.add(camera);
	
	//controls = new THREE.OrbitControls( camera, renderer.domElement );//3D閲覧
	THREEx.WindowResize(renderer, camera);
}


function update()
{	
	//controls.update();
	//stats.update();
	
	var dt = clock.getDelta();
	engine.update( dt * 0.5 );
}

function render() 
{
	renderer.render( scene, camera );
}


</script>

@endsection