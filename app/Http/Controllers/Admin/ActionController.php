<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Action;
use App\Http\Requests\ActionRequest; 

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::orderBy('active_flg', 'desc')->get();
        return view('admin/action/index', compact('actions'));
    }

    public function create()
    {
        return view('admin/action/create');
    }

    public function store(ActionRequest $request)
    {
        Action::create([
          'name' => $request->name,
          'name_sub' => $request->name_sub,
          'active_flg' => true,
        ]);
        return redirect()->route('action.index');
    }

    public function edit($id)
    {
        $action = Action::find($id);
        return view('admin/action/edit')->with('action', $action);
    }

    public function update(ActionRequest $request, $id)
    {
        $action = Action::find($id);
        $action->name = $request->name;
        $action->name_sub = $request->name_sub;
        $action->active_flg = $request->active_flg;
        $action->save();
 
        return redirect()->route('action.index');
    }

    public function destroy($id)
    {
        $action = Action::findOrFail($id);
        $action->delete();
        
        return redirect()->route('action.index');
    }
}
