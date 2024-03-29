<html lang="en"><head>
	<title>Particle Engine (Three.js)</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="{{ asset('/assets/css/explode2023/base.css') }}">
<style type="text/css">.dg ul{list-style:none;margin:0;padding:0;width:100%;clear:both}.dg.ac{position:fixed;top:0;left:0;right:0;height:0;z-index:0}.dg:not(.ac) .main{overflow:hidden}.dg.main{-webkit-transition:opacity 0.1s linear;-o-transition:opacity 0.1s linear;-moz-transition:opacity 0.1s linear;transition:opacity 0.1s linear}.dg.main.taller-than-window{overflow-y:auto}.dg.main.taller-than-window .close-button{opacity:1;margin-top:-1px;border-top:1px solid #2c2c2c}.dg.main ul.closed .close-button{opacity:1 !important}.dg.main:hover .close-button,.dg.main .close-button.drag{opacity:1}.dg.main .close-button{-webkit-transition:opacity 0.1s linear;-o-transition:opacity 0.1s linear;-moz-transition:opacity 0.1s linear;transition:opacity 0.1s linear;border:0;position:absolute;line-height:19px;height:20px;cursor:pointer;text-align:center;background-color:#000}.dg.main .close-button:hover{background-color:#111}.dg.a{float:right;margin-right:15px;overflow-x:hidden}.dg.a.has-save ul{margin-top:27px}.dg.a.has-save ul.closed{margin-top:0}.dg.a .save-row{position:fixed;top:0;z-index:1002}.dg li{-webkit-transition:height 0.1s ease-out;-o-transition:height 0.1s ease-out;-moz-transition:height 0.1s ease-out;transition:height 0.1s ease-out}.dg li:not(.folder){cursor:auto;height:27px;line-height:27px;overflow:hidden;padding:0 4px 0 5px}.dg li.folder{padding:0;border-left:4px solid rgba(0,0,0,0)}.dg li.title{cursor:pointer;margin-left:-4px}.dg .closed li:not(.title),.dg .closed ul li,.dg .closed ul li > *{height:0;overflow:hidden;border:0}.dg .cr{clear:both;padding-left:3px;height:27px}.dg .property-name{cursor:default;float:left;clear:left;width:40%;overflow:hidden;text-overflow:ellipsis}.dg .c{float:left;width:60%}.dg .c input[type=text]{border:0;margin-top:4px;padding:3px;width:100%;float:right}.dg .has-slider input[type=text]{width:30%;margin-left:0}.dg .slider{float:left;width:66%;margin-left:-5px;margin-right:0;height:19px;margin-top:4px}.dg .slider-fg{height:100%}.dg .c input[type=checkbox]{margin-top:9px}.dg .c select{margin-top:5px}.dg .cr.function,.dg .cr.function .property-name,.dg .cr.function *,.dg .cr.boolean,.dg .cr.boolean *{cursor:pointer}.dg .selector{display:none;position:absolute;margin-left:-9px;margin-top:23px;z-index:10}.dg .c:hover .selector,.dg .selector.drag{display:block}.dg li.save-row{padding:0}.dg li.save-row .button{display:inline-block;padding:0px 6px}.dg.dialogue{background-color:#222;width:460px;padding:15px;font-size:13px;line-height:15px}#dg-new-constructor{padding:10px;color:#222;font-family:Monaco, monospace;font-size:10px;border:0;resize:none;box-shadow:inset 1px 1px 1px #888;word-wrap:break-word;margin:12px 0;display:block;width:440px;overflow-y:scroll;height:100px;position:relative}#dg-local-explain{display:none;font-size:11px;line-height:17px;border-radius:3px;background-color:#333;padding:8px;margin-top:10px}#dg-local-explain code{font-size:10px}#dat-gui-save-locally{display:none}.dg{color:#eee;font:11px 'Lucida Grande', sans-serif;text-shadow:0 -1px 0 #111}.dg.main::-webkit-scrollbar{width:5px;background:#1a1a1a}.dg.main::-webkit-scrollbar-corner{height:0;display:none}.dg.main::-webkit-scrollbar-thumb{border-radius:5px;background:#676767}.dg li:not(.folder){background:#1a1a1a;border-bottom:1px solid #2c2c2c}.dg li.save-row{line-height:25px;background:#dad5cb;border:0}.dg li.save-row select{margin-left:5px;width:108px}.dg li.save-row .button{margin-left:5px;margin-top:1px;border-radius:2px;font-size:9px;line-height:7px;padding:4px 4px 5px 4px;background:#c5bdad;color:#fff;text-shadow:0 1px 0 #b0a58f;box-shadow:0 -1px 0 #b0a58f;cursor:pointer}.dg li.save-row .button.gears{background:#c5bdad url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAsAAAANCAYAAAB/9ZQ7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAQJJREFUeNpiYKAU/P//PwGIC/ApCABiBSAW+I8AClAcgKxQ4T9hoMAEUrxx2QSGN6+egDX+/vWT4e7N82AMYoPAx/evwWoYoSYbACX2s7KxCxzcsezDh3evFoDEBYTEEqycggWAzA9AuUSQQgeYPa9fPv6/YWm/Acx5IPb7ty/fw+QZblw67vDs8R0YHyQhgObx+yAJkBqmG5dPPDh1aPOGR/eugW0G4vlIoTIfyFcA+QekhhHJhPdQxbiAIguMBTQZrPD7108M6roWYDFQiIAAv6Aow/1bFwXgis+f2LUAynwoIaNcz8XNx3Dl7MEJUDGQpx9gtQ8YCueB+D26OECAAQDadt7e46D42QAAAABJRU5ErkJggg==) 2px 1px no-repeat;height:7px;width:8px}.dg li.save-row .button:hover{background-color:#bab19e;box-shadow:0 -1px 0 #b0a58f}.dg li.folder{border-bottom:0}.dg li.title{padding-left:16px;background:#000 url(data:image/gif;base64,R0lGODlhBQAFAJEAAP////Pz8////////yH5BAEAAAIALAAAAAAFAAUAAAIIlI+hKgFxoCgAOw==) 6px 10px no-repeat;cursor:pointer;border-bottom:1px solid rgba(255,255,255,0.2)}.dg .closed li.title{background-image:url(data:image/gif;base64,R0lGODlhBQAFAJEAAP////Pz8////////yH5BAEAAAIALAAAAAAFAAUAAAIIlGIWqMCbWAEAOw==)}.dg .cr.boolean{border-left:3px solid #806787}.dg .cr.function{border-left:3px solid #e61d5f}.dg .cr.number{border-left:3px solid #2fa1d6}.dg .cr.number input[type=text]{color:#2fa1d6}.dg .cr.string{border-left:3px solid #1ed36f}.dg .cr.string input[type=text]{color:#1ed36f}.dg .cr.function:hover,.dg .cr.boolean:hover{background:#111}.dg .c input[type=text]{background:#303030;outline:none}.dg .c input[type=text]:hover{background:#3c3c3c}.dg .c input[type=text]:focus{background:#494949;color:#fff}.dg .c .slider{background:#303030;cursor:ew-resize}.dg .c .slider-fg{background:#2fa1d6}.dg .c .slider:hover{background:#3c3c3c}.dg .c .slider:hover .slider-fg{background:#44abda}
</style></head>
<body>

<script src="{{ asset('/assets/js/explode2023/Three.js/js/Three.js') }}"></script>
<script src="{{ asset('/assets/js/explode2023/Three.js/js/Detector.js') }}"></script>
<script src="{{ asset('/assets/js/explode2023/Three.js/js/Stats.js') }}"></script>
<script src="{{ asset('/assets/js/explode2023/Three.js/js/OrbitControls.js') }}"></script>
<script src="{{ asset('/assets/js/explode2023/Three.js/js/THREEx.KeyboardState.js') }}"></script>
<script src="{{ asset('/assets/js/explode2023/Three.js/js/THREEx.FullScreen.js') }}"></script>
<script src="{{ asset('/assets/js/explode2023/Three.js/js/THREEx.WindowResize.js') }}"></script>

<script src="{{ asset('/assets/js/explode2023/Three.js/js/ParticleEngine.js') }}"></script>
<script src="{{ asset('/assets/js/explode2023/Three.js/js/ParticleEngineExamples.js') }}"></script>

<!-- GUI for experimenting with values -->		
<script type="text/javascript" src="{{ asset('/assets/js/explode2023/Three.js/js/DAT.GUI.min.js') }}"></script>

<!-- jQuery code to display an information button and box when clicked. -->
<script src="{{ asset('/assets/js/explode2023/Three.js/js/jquery-1.9.1.js') }}"></script>
<script src="{{ asset('/assets/js/explode2023/Three.js/js/jquery-ui.js') }}"></script>
<link rel="stylesheet" href="{{ asset('/assets/css/explode2023/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/explode2023//info.css') }}">
<script src="{{ asset('/assets/js/explode2023/Three.js/js/info.js') }}"></script>
<div id="infoButton" style="z-index: 2; background: none; opacity: 0.9; position: absolute; top: 4px; left: 4px;" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"><img src="images/icon-info.png" width="32" height="32"></span></div>

<!-- ------------------------------------------------------------ -->

<div id="ThreeJS" style="position: absolute; left:0px; top:0px"><canvas width="506" height="747"></canvas><div style="cursor: pointer; width: 80px; opacity: 0.9; z-index: 100; position: absolute; bottom: 0px;"><div style="text-align: left; line-height: 1.2em; background-color: rgb(8, 8, 24); padding: 0px 0px 3px 3px;"><div style="font-family: Helvetica, Arial, sans-serif; font-size: 9px; color: rgb(0, 255, 255); font-weight: bold;">60 FPS (0-61)</div><div style="position: relative; width: 74px; height: 30px; background-color: rgb(0, 255, 255);"><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 25.2px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 20.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 26.1px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 22.8px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.4px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.4px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.4px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 29.7px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 30px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 22.8px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span><span style="width: 1px; height: 12px; float: left; background-color: rgb(16, 16, 48);"></span></div></div><div style="text-align: left; line-height: 1.2em; background-color: rgb(8, 24, 8); padding: 0px 0px 3px 3px; display: none;"><div style="font-family: Helvetica, Arial, sans-serif; font-size: 9px; color: rgb(0, 255, 0); font-weight: bold;">17 MS (4-63989)</div><div style="position: relative; width: 74px; height: 30px; background-color: rgb(0, 255, 0);"><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.3px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.3px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 26.85px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 25.95px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 28.8px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 28.2px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.3px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.3px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 28.05px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.3px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.3px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.3px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.15px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.3px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.15px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.9px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.15px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.75px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.3px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.6px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span><span style="width: 1px; height: 27.45px; float: left; background-color: rgb(16, 48, 16);"></span></div></div></div></div>
<script>
/*
	Three.js "tutorials by example"
	Author: Lee Stemkoski
	Date: July 2013 (three.js v59dev)
*/

// MAIN

// standard global variables
var container, scene, camera, renderer, controls, stats;
var keyboard = new THREEx.KeyboardState();
var clock = new THREE.Clock();
// custom global variables
var cube;

init();
animate();

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
	renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);
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
	container.appendChild( stats.domElement );
	// LIGHT
	var light = new THREE.PointLight(0xffffff);
	light.position.set(0,250,0);
	scene.add(light);
	// FLOOR
	var floorTexture = new THREE.ImageUtils.loadTexture( 'images/checkerboard.jpg' );
	floorTexture.wrapS = floorTexture.wrapT = THREE.RepeatWrapping; 
	floorTexture.repeat.set( 10, 10 );
	var floorMaterial = new THREE.MeshBasicMaterial( { color: 0x444444, map: floorTexture, side: THREE.DoubleSide } );
	var floorGeometry = new THREE.PlaneGeometry(1000, 1000, 10, 10);
	var floor = new THREE.Mesh(floorGeometry, floorMaterial);
	floor.position.y = -10.5;
	floor.rotation.x = Math.PI / 2;
	scene.add(floor);
	// SKYBOX/FOG
	var skyBoxGeometry = new THREE.CubeGeometry( 4000, 4000, 4000 );
	var skyBoxMaterial = new THREE.MeshBasicMaterial( { color: 0x000000, side: THREE.BackSide } );
	var skyBox = new THREE.Mesh( skyBoxGeometry, skyBoxMaterial );
    scene.add(skyBox);
	
	////////////
	// CUSTOM //
	////////////

	
	this.engine = new ParticleEngine();
	engine.setValues( Examples.fountain );
	engine.initialize();
	
	// GUI for experimenting with parameters

	gui = new dat.GUI();	
	parameters = 
	{
		fountain:   function() { restartEngine( Examples.fountain   ); },
		startunnel: function() { restartEngine( Examples.startunnel ); },		
		starfield:  function() { restartEngine( Examples.starfield  ); },		
		fireflies:  function() { restartEngine( Examples.fireflies  ); },		
		clouds:     function() { restartEngine( Examples.clouds     ); },		
		smoke:      function() { restartEngine( Examples.smoke      ); },		
		fireball:   function() { restartEngine( Examples.fireball   ); },		
		candle:     function() { restartEngine( Examples.candle     ); },		
		rain:       function() { restartEngine( Examples.rain       ); },		
		snow:       function() { restartEngine( Examples.snow       ); },		
		firework:   function() { restartEngine( Examples.firework   ); }		
	};

	gui.add( parameters, 'fountain'   ).name("Star Fountain");
	gui.add( parameters, 'startunnel' ).name("Star Tunnel");
	gui.add( parameters, 'starfield'  ).name("Star Field");
	gui.add( parameters, 'fireflies'  ).name("Fireflies");
	gui.add( parameters, 'clouds'     ).name("Clouds");
	gui.add( parameters, 'smoke'      ).name("Smoke");
	gui.add( parameters, 'fireball'   ).name("Fireball");
	gui.add( parameters, 'candle'     ).name("Candle");
	gui.add( parameters, 'rain'       ).name("Rain");
	gui.add( parameters, 'snow'       ).name("Snow");
	gui.add( parameters, 'firework'   ).name("Firework");
	
	gui.open();	
}

function animate() 
{
    requestAnimationFrame( animate );
	render();		
	update();
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
	
	controls = new THREE.OrbitControls( camera, renderer.domElement );
	THREEx.WindowResize(renderer, camera);
}


function update()
{
/*
	if ( keyboard.pressed("1") ) 
		restartEngine( fountain );
	if ( keyboard.pressed("2") ) 
		restartEngine( startunnel );
	if ( keyboard.pressed("3") ) 
		restartEngine( starfield );
	if ( keyboard.pressed("4") ) 
		restartEngine( fireflies );
		
	if ( keyboard.pressed("5") ) 
		restartEngine( clouds );
	if ( keyboard.pressed("6") ) 
		restartEngine( smoke );
		
	if ( keyboard.pressed("7") ) 
		restartEngine( fireball );
	if ( keyboard.pressed("8") ) 
		restartEngine( Examples.candle );
		
	if ( keyboard.pressed("9") ) 
		restartEngine( rain );
	if ( keyboard.pressed("0") ) 
		restartEngine( snow );
		
	if ( keyboard.pressed("q") ) 
		restartEngine( firework );
	// also: reset camera angle
*/
	
	controls.update();
	stats.update();
	
	var dt = clock.getDelta();
	engine.update( dt * 0.5 );	
}

function render() 
{
	renderer.render( scene, camera );
}

</script>

</body>
</html>
