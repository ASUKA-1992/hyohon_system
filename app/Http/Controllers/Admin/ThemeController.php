<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Http\Requests\ThemeRequest; 

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::orderBy('active_flg', 'desc')->get();
        return view('admin/theme/index', compact('themes'));
    }

    public function create()
    {
        return view('admin/theme/create');
    }

    public function store(ThemeRequest $request)
    {
    	$note = $request->note;
    	if(is_null($note)){
    		$note = "";
    	}
        Theme::create([
          'name' => $request->name,
          'note' => $note,
          'active_flg' => true,
        ]);
        return redirect()->route('theme.index');
    }

    public function edit($id)
    {
        $theme = Theme::find($id);
        return view('admin/theme/edit')->with('theme', $theme);
    }

    public function update(ThemeRequest $request, $id)
    {
        $theme = Theme::find($id);
        $theme->name = $request->name;
        if(is_null($request->note)){
        	$theme->note = "";
        }else{
        	$theme->note = $request->note;
        }
        $theme->active_flg = $request->active_flg;
        $theme->save();
 
        return redirect()->route('theme.index');
    }

    public function destroy($id)
    {
        $theme = Theme::findOrFail($id);
        $theme->delete();
        
        return redirect()->route('theme.index');
    }
}
