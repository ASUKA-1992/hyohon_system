<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Meeting;
use App\Models\Theme;
use App\Models\Role;
use App\Models\Action;
use App\Models\Participant;
use App\Http\Requests\MeetingRequest; 

class MeetingController extends Controller
{
    public function index(Request $request)
    {
    	$search = isset($request->search) ? $request->search : 'all';
		
        if($search == "active"){
            $meetings = Meeting::where('status', '<>', '99')->orderBy('created_at', 'desc')->get();
        } elseif($search == "finish") {
        	$meetings = Meeting::where('status', '=', '99')->orderBy('created_at', 'desc')->get();
        } else {
            $meetings = Meeting::orderBy('created_at', 'desc')->get();
        }
        return view('meeting/index', compact('meetings', 'search'));
    }

    public function show(Request $request, $id)
    {
        $meeting = Meeting::find($id);
        $participants = Participant::where('meeting_id', $id)->get();
        
        // 結果
        $meeting_result = null;
        $yes_cnt = 0;
        $no_cnt = 0;
        foreach ($participants as $participant){
            if(is_null($participant->answer2)){
                continue;
            }
            if($participant->answer2 == 0){
                $no_cnt++;
            }else{
                $yes_cnt++;
            }
        }
        if($no_cnt < $yes_cnt){
            $meeting_result = "YES";
        } elseif($no_cnt > $yes_cnt ) {
            $meeting_result = "NO";
        } else {
            $meeting_result = "引き分け";
        }

        return view('meeting/show', compact('meeting', 'participants', 'meeting_result', 'request'));
    }

    public function create()
    {
        $themes = Theme::where('active_flg', true)->get();
        $roles = Role::where('active_flg', true)->get();
        $actions = Action::where('active_flg', true)->get();
        return view('meeting/create', compact('themes', 'roles', 'actions'));
    }

    public function store(MeetingRequest $request)
    {
        $participants_num = $request->participants_num;
        $participants_name_arr = [];
        $role_ids = $request->role;
        $action_ids = $request->action;

        // バリデーション/役割
        if(count($role_ids) < $participants_num){
            // エラー
            var_dump("選択エラー：選択されている役割が参加者数より少ないです。");
            return;
        }
        // バリデーション/アクション
        if(count($action_ids) < $participants_num){
            // エラー
            var_dump("選択エラー：選択されているアクションが参加者数より少ないです。");
            return;
        }

        //タグの空白削除
        $insert_tag = null;
        if(!is_null($request->tag)){
            // 半角スペース削除
            $wk_tag = trim($request->tag);
            $wk_tag = preg_replace('/\A\s+|\s+\z/u', '', $wk_tag);
            if($wk_tag != ""){
                $insert_tag = $wk_tag;
            }
        }
    
        try {
            DB::beginTransaction();
            // 会議登録
            $meeting = Meeting::create([
                'name' => $request->name,
                'title' => $request->title,
                'tag' => $insert_tag,
            ]);

            // ファシリテーター
            Participant::create([
                'meeting_id' => $meeting->id,
                'name' => $request->owner,
                'owner_type' => 2,
                'role_open' => 1,
                'action_open' => 1,
            ]);
        
            // 役割をシャッフル
            shuffle($role_ids);
            // アクションをシャッフル        
            shuffle($action_ids);
            
            for ($i=1; $i <= $participants_num; $i++) { 
                $owner_type =1;
                $name = null;

                // 役割とアクション取り出し
                $role_id = array_shift($role_ids);
                $role = Role::find($role_id); 
                $action_id = array_shift($action_ids);
                $action = Action::find($action_id); 

                Participant::create([
                    'meeting_id' => $meeting->id,
                    'name' => $name,
                    'owner_type' => $owner_type,
                    'role_name' => $role->name,
                    'role_name_sub' => $role->name_sub,
                    'action_name' => $action->name,
                    'action_name_sub' => $action->name_sub,
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('meeting.index');
    }

    public function select_meeting()
    {
        $meetings = Meeting::where('status', '!=', '99')->orderBy('created_at', 'desc')->get();
        return view('meeting/select_meeting', compact('meetings'));
    }

    public function destroy(Request $request, $id)
    {
    	$search = isset($request->search) ? $request->search : 'all';
    
        $meeting = Meeting::findOrFail($id);
        $meeting->participants()->delete();
        $meeting->delete();
        return redirect()->route('meeting.index', ['search' => $search]);
    }
    
    public function comment($id)
    {
    	$meeting = Meeting::find($id);
    	return view('meeting/comment', compact('meeting'));
    }
    
    public function comment_store(Request $request, $id)
    {
    	$meeting = Meeting::find($id);
    	$meeting->comment = $request->comment;
    	$result = $meeting->save();
    	return redirect()->route('meeting.index');
    }

}
