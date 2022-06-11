@extends('layout.admin.common',['title'=>'会議閲覧'])
@section('content')
    <table class="elm_center admin_table">
    @foreach ($participants as $participant)
        <tr class="">
            <td>{{ $participant->name }}</td>
            <td>{{ $participant->role_name }}</td>
            <td>{{ config("const.roles.name_sub")[$participant->role_name_sub] }}</td>
            <td>{{ $participant->action_name }}</td>
            <td>{{ config("const.actions.name_sub")[$participant->action_name_sub] }}</td>
        </tr>
    @endforeach
    </table>

@endsection