<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Theme;
use App\Models\Role;
use App\Models\Action;
use App\Models\Participant;

class ParticipantController extends Controller
{
    public function index($meeting_id)
    {
        // 参加者をミーティングで絞込み
        $participants = Participant::where('meeting_id', $meeting_id)->get();
        $participant_cnt = Participant::where([['meeting_id', '=', $meeting_id], ['owner_type', '<>', 2]])->count();
        $no_name_cnt = Participant::where('meeting_id', $meeting_id)->whereNull('name')->count();
        $meeting = Meeting::find($meeting_id);
        
        return view('participant/index', compact('participants', 'meeting', 'no_name_cnt', 'participant_cnt'));
    }

    public function input_name(Request $request, $meeting_id)
    {
        $participant = Participant::where('meeting_id', $meeting_id)->whereNull('name')->orderBy('id', 'asc')->first();

        if(is_null($participant)){
            return redirect()->route('participant.index', $meeting_id);
        }

        return view('participant/input_name', compact('request', 'participant'));   
    }

    public function input_name_store(Request $request, $meeting_id)
    {
        // 参加者名の登録
        $participant = Participant::where('meeting_id', $meeting_id)->whereNull('name')->orderBy('id', 'asc')->first();
        if(is_null($request->name) || empty(trim($request->name)) || is_null($participant)){
            return redirect()->route('participant.input_name', [$meeting_id, 'no_name' => 1]);
        }

        //バリデーション
        $name = trim($request->name);
        $participants = Participant::where('meeting_id', $meeting_id)->whereNotNull('name')->orderBy('id', 'asc')->get();
        foreach ($participants as $target){
            if($target->name == $name){
                return redirect()->route('participant.input_name', [$meeting_id, 'dup_name' => 1]);
            }
        }

        $participant->name = $name;
        $participant->save();
        
        return redirect()->route('participant.index', $meeting_id);
    }

    public function show($id)
    {
        // まずは必須で必要な情報取得
        $participant = Participant::find($id);
        $participants = Participant::where('meeting_id', $participant->meeting_id)->get();
        $status = $participant->meeting->status;

        // オーナーの場合、専用画面へ
        if($participant->owner_type == 2 && \Session::get('login_admin')){
            return view('participant/owner', compact('participant', 'participants', 'status'));
        }

        // 名前入力者が2名未満→会議が成立しないため、待機所にリダイレクト
        $participant_name_cnt = Participant::where([['meeting_id', $participant->meeting_id],['owner_type', '<>', 2]])->whereNotNull('name')->count();
        if($participant_name_cnt < 2){
            return redirect()->route('participant.index', $participant->meeting_id);
        }
        
        $answerd_flg = true;

        

        switch ($participant->meeting->status) {
            case '1':
            case '6':
                //会議開始前or会議①終了→待機所にリダイレクト
                return redirect()->route('participant.index', $participant->meeting_id);

            case '2':
                return view('participant/open_title', compact('participant'));

            case '3':
                return view('participant/open_role', compact('participant'));
			
			case '4':
                return view('participant/answer1', compact('participant'));
            
            case '5':
                // 役割開示済
                foreach ($participants as $key => $value) {
                    if(is_null($value->answer1) && $value->owner_type != 2){
                        $answerd_flg = false;
                        break;
                    }
                }
                return view('participant/meeting1', compact('participant', 'participants', 'answerd_flg', 'participant_name_cnt'));

            case '7':
                return view('participant/open_action', compact('participant'));

            case '8':
                // アクション開示済
                foreach ($participants as $key => $value) {
                    if(is_null($value->answer2) && $value->owner_type != 2){
                        $answerd_flg = false;
                        break;
                    }
                }
                return view('participant/meeting2', compact('participant', 'participants', 'answerd_flg', 'participant_name_cnt'));
            
            case '9':
                return view('participant/answer2', compact('participant'));
            
            case '10':
            	// 結果取得
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
		        
                return view('participant/result', compact('participant', 'meeting_result'));
                
            case '99':
            	return redirect()->route('meeting.show', $participant->meeting_id);
            default:
                # code...
                break;
        }
    }

    public function meeting1_select($id, Request $request)
    {
        $participant = Participant::find($id);
        $participant->answer1 = $request->answer;
        $result = $participant->save();
        return $result;
    }

    public function meeting2_select($id, Request $request)
    {
        $participant = Participant::find($id);
        $participant->answer2 = $request->answer;
        $result = $participant->save();
        return $result;
    }
    

    public function role_open($id)
    {
        $participant = Participant::find($id);
        $participant->role_open = 1;
        $result = $participant->save();
        return $result;
    }

    public function action_open($id)
    {
        $participant = Participant::find($id);
        $participant->action_open = 1;
        $result = $participant->save();
        return $result;
    }

    //管理者専用 ステータス変更
    public function status_change($id, $new_status_id)
    {
        $participant = Participant::find($id);
        $meeting = Meeting::find($participant->meeting_id);
        $meeting->status = $new_status_id;
        
        // 会議開始、会議1、会議2終了の際は日時を登録する
        if($new_status_id == 2){
        	$meeting->start_date = date('Y-m-d H:i:s');
        }
        
        if($new_status_id == 6){
        	$meeting->status1_end_date = date('Y-m-d H:i:s');
        }
        
        if($new_status_id == 99){
        	$meeting->status2_end_date = date('Y-m-d H:i:s');
        }
        
        $result = $meeting->save();
        return redirect()->route('participant.show', $id);
    }
}
