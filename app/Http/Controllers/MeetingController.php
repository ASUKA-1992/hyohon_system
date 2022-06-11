<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Theme;
use App\Models\Role;
use App\Models\Action;
use App\Models\Participant;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::orderBy('created_at', 'desc')->get();
        return view('meeting/index', compact('meetings'));
    }

    public function show($id)
    {
        $meeting = Meeting::find($id);
        $participants = Participant::where('meeting_id', $id)->get();
        return view('meeting/show', compact('meeting', 'participants'));
    }

    public function create()
    {
        $themes = Theme::where('active_flg', true)->get();
        $roles = Role::where('active_flg', true)->get();
        $actions = Action::where('active_flg', true)->get();
        return view('meeting/create', compact('themes', 'roles', 'actions'));
    }

    public function store(Request $request)
    {
        $participants_num = $request->participants_num;
        $role_ids = $request->role;
        $action_ids = $request->action;

        // バリデーション/参加者名
        for ($i=1; $i <= $participants_num; $i++) { 
            if(empty($request["participant_". $i])){
                // エラー
                var_dump("1");
                return;
            }
        }
        // バリデーション/役割
        if(count($role_ids) < $participants_num){
            // エラー
            var_dump("2");
            return;
        }
        // バリデーション/アクション
        if(count($action_ids) < $participants_num){
            // エラー
            var_dump("3");
            return;
        }

        // 会議登録
        $meeting = Meeting::create([
            'title' => $request->title,
        ]);

        // オーナー会議参加有無取得
        $owner_join_flg = is_null($request->owner_join_flg)? false : true;

        // オーナーが参加しない場合
        if(!$owner_join_flg){
            Participant::create([
                'meeting_id' => $meeting->id,
                'name' => $request->owner,
                'owner_type' => 2,
            ]);
        }

        // 役割をシャッフル
        shuffle($role_ids);
        // アクションをシャッフル        
        shuffle($action_ids);
        
        for ($i=1; $i <= $participants_num; $i++) { 
            $owner_type = 1;
            if($owner_join_flg && $i==1){
                // オーナーが参加する場合、必ず先頭がオーナーになる
                $owner_type = 3;
            } 
            // 役割とアクション取り出し
            $role_id = array_shift($role_ids);
            $role = Role::find($role_id); 
            $action_id = array_shift($action_ids);
            $action = Action::find($action_id); 

            Participant::create([
                'meeting_id' => $meeting->id,
                'name' => $request["participant_". $i],
                'owner_type' => $owner_type,
                'role_name' => $role->name,
                'role_name_sub' => $role->name_sub,
                'action_name' => $action->name,
                'action_name_sub' => $action->name_sub,
            ]);
        }
    }
}
