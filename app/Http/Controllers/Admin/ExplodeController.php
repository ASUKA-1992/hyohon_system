<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Explode;
use App\Http\Requests\ExplodeRequest; 

class ExplodeController extends Controller
{
    public function index()
    {
        $explodes = Explode::orderBy('order')->get();
        return view('admin/explode/index', compact('explodes'));
    }

    public function show(Request $request, $id)
    {
        $explode = Explode::find($id);
        
        // JS用に粒子色の文字列置き換え
        $colors = str_replace('#', '0x', $explode->colors);

        //前へ、次へ
        $previous=Explode::where('order', '<', $explode->order)->orderBy('order', 'desc')->first();
        $next=Explode::where('order', '>', $explode->order)->orderBy('order')->first();

        return view('admin/explode/show', compact('explode', 'colors', 'previous', 'next'));
    }

    public function create()
    {
        return view('admin/explode/create');
    }

    public function store(ExplodeRequest $request)
    {
        // 色をカンマ区切りで設定
        $colors = "";
        for ($i=1; $i <= $request->color_num; $i++) {
            if($colors != ""){
                $colors =  $colors . "," . $request["color_". $i];
            } else {
                $colors =  $request["color_". $i];
            }
        }

        Explode::create([
          'name' => $request->name,
          'note' => $request->note,
          'place' => $request->place,
          'speed' => $request->speed,
          'quantity' => $request->quantity,
          'size' => $request->size,
          'front_bigger' => $request->front_bigger,
          'colors' => $colors,
          'count' => $request->count,
          'order' => $request->order,
        ]);
        return redirect()->route('explode.index');
    }

    public function edit($id)
    {
        $explode = Explode::find($id);
        $color_num = explode(",", $explode->colors);
        return view('admin/explode/edit', compact('explode', 'color_num'));
    }

    public function update(ExplodeRequest $request, $id)
    {
        $explode = Explode::find($id);

        // 色をカンマ区切りで設定
        $colors = "";
        for ($i=1; $i <= $request->color_num; $i++) {
            if($colors != ""){
                $colors =  $colors . "," . $request["color_". $i];
            } else {
                $colors =  $request["color_". $i];
            }
        }

        $explode->name = $request->name;
        $explode->note = $request->note;
        $explode->place = $request->place;
        $explode->speed = $request->speed;
        $explode->quantity = $request->quantity;
        $explode->size = $request->size;
        $explode->front_bigger = $request->front_bigger;
        $explode->colors = $colors;
        $explode->count = $request->count;
        $explode->order = $request->order;
        $explode->save();
 
        return redirect()->route('explode.index');
    }

    public function destroy($id)
    {
        $explode = Explode::findOrFail($id);
        $explode->delete();
        
        return redirect()->route('explode.index');
    }
}
