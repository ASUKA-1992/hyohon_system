<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Explode;
use App\Models\ExplodeWorkshop;
use App\Http\Requests\ExplodeWorkshopRequest; 


class ExplodeWorkshopController extends Controller
{
	public function show(Request $request, $id)
    {
        $explodes = Explode::where('order',  $id)->orderBy('created_at')->get();
        $example_explodes = Explode::where([['order', '>', 900], ['order', '<=', 1000]])->orderBy('order')->get();
        
        $whokshop = ExplodeWorkshop::find($id);
        return view('explode/workshop/show', compact('explodes', 'example_explodes', "whokshop"));
    }


    public function create()
    {
        return view('explode/workshop/create');
    }
    
    public function store(ExplodeWorkshopRequest $request)
    {
        ExplodeWorkshop::create([
          'name' => $request->name
        ]);
        return redirect()->route('explode.index');
    }
    
    public function edit($id)
    {
        $workshop = ExplodeWorkshop::find($id);
        return view('explode/workshop/edit', compact('workshop'));
    }
    
    public function update(ExplodeWorkshopRequest $request, $id)
    {
        $workshop = ExplodeWorkshop::find($id);

        $workshop->name = $request->name;
        $workshop->save();
 
        return redirect()->route('explode.index');
    }
}
