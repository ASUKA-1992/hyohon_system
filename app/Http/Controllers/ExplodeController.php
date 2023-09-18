<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Explode;
use App\Models\ExplodeWorkshop;
use App\Http\Requests\ExplodeRequest; 

class ExplodeController extends Controller
{
    public function index()
    {
        $whokshops = ExplodeWorkshop::orderBy('order')->get();
        
        //ワークショップIDの配列作成
        $whokshop_ids = [];
        foreach ($whokshops as $whokshop) {
        	$whokshop_ids[] = $whokshop->id;
        }
        
        $explodes = Explode::where('order', '<=', 900)->whereNotIn('order', $whokshop_ids)->orderBy('created_at')->get();
        return view('explode/index', compact('explodes', "whokshops"));
    }

    public function index_honban(Request $request)
    {
    	$workshop_id = $request->workshop_id;
        $explodes = Explode::where('order',  $workshop_id)->orderBy('created_at')->get();
        return view('explode/index_honban', compact('explodes', 'workshop_id'));
    }

    public function show(Request $request, $id)
    {
        $explode = Explode::find($id);
        
        // JS用に粒子色の文字列置き換え
        $colors = str_replace('#', '0x', $explode->colors);

        //前へ、次へ
        $previous=Explode::where('order', '<', $explode->order)->orderBy('order', 'desc')->first();
        $next=Explode::where('order', '>', $explode->order)->orderBy('order')->first();

        return view('explode/show', compact('explode', 'colors', 'previous', 'next'));
    }

    public function create(Request $request)
    {
    	$order = $request->workshop_id;
        return view('explode/create', compact('order'));
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

        if($request->order == null){
            $request->order = 1;
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
        return redirect()->route('explode_workshop.show', $request->order);
    }

    public function edit($id)
    {
        $explode = Explode::find($id);
        $color_num = explode(",", $explode->colors);
        $whokshops = ExplodeWorkshop::orderBy('order')->get();
        return view('explode/edit', compact('explode', 'color_num', 'whokshops'));
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

        if($request->order == null){
            $request->order = 1;
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
 
        return redirect()->route('explode_workshop.show', $explode->order);
    }

    public function destroy($id)
    {
        $explode = Explode::findOrFail($id);
        $order = $explode->order;
        $explode->delete();
        
        return redirect()->route('explode_workshop.show', $order);
    }

    public function sample_2023(Request $request, $id)
    {
        $explode = Explode::find($id);
        
        // JS用に粒子色の文字列置き換え
        $colors = str_replace('#', '0x', $explode->colors);

        //前へ、次へ
        $previous=Explode::where('order', '<', $explode->order)->orderBy('order', 'desc')->first();
        $next=Explode::where('order', '>', $explode->order)->orderBy('order')->first();

        return view('explode/sample_2023', compact('explode', 'colors', 'previous', 'next'));
    }
}
