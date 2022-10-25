<?php
return [
    "label" => [
        "meeting_name" => "会議名",
        "meeting_title" => "テーマ",
        "role" => "職業",
        "action" => "アクション",
        "tag" =>  "メモ",
        "owner" =>  "ファシリテーター",
        "status" =>  "ステータス",
        "comment" =>  "コメント",
    ],
    "messages" => [
        1 => "会議が終了しました。",
    ],
    "roles" => [
        "name_sub" => [
            1 => "官・公務員",
            2 => "自営・フリー",
            3 => "民間企業勤め",
            4 => "スペシャル",
        ],
    ],
    "actions" => [
        "name_sub" => [
            1 => "ソーシャルグッド",
            2 => "スキャンダル",
        ],
    ],
    "meetings" => [
        "status" => [
            1 => "会議開始前",
            2 => "テーマ開示",
            3 => "役割開示",
            4 => "初期意見",
            5 => "会議①",
            6 => "会議①終了",
            7 => "アクション開示",
            8 => "会議②",
            9 => "最終決議",
            10 => "結果発表",
            99 => "終了",
        ],
        "status_en" => [
            1 => "before_meeting",
            2 => "open_title",
            3 => "open_role",
            4 => "answer1",
            5 => "meeting1",
            6 => "finish1",
            7 => "open_action",
            8 => "meeting2",
            9 => "answer2",
            10 =>"result",
            99 =>"finish2",
        ],
    ],
    "participants" => [
        "owner_type" => [
            1 => "非オーナー",
            2 => "会議非参加",
            3 => "会議参加",
        ],
        "answer" => [
            0 => "NO",
            1 => "YES",
        ],
    ],
    "admin_password" =>  env('ADMIN_PASSWORD'),

    // Explode(標本システム関係なし)
    "explodes" => [
        "place" => [
            1 => "center",
            2 => "top",
            3 => "bottom",
            4 => "all sides",
            5 => "random",
        ],
    ],
];