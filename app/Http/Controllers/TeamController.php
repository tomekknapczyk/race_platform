<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\TeamMember;
use App\TeamRequest;

class TeamController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $teams = Team::get();

        return view('teams', compact('teams'));
    }

    public function show($id)
    {
        $team = Team::where('id', $id)->first();

        if(!$team)
            back()->with('danger', 'Team nie istnieje');

        return view('public-team', compact('team'));
    }

    public function dashboard()
    {
        // jeżeli jest team to pokaż tylko team
        $team = auth()->user()->team();
            
        if($team)
            return view('team', compact('team'));
        // jeżeli nie ma team pokaż zaproszenia i button do dodania swojego
            // $team_requests
        return view('newteam');
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'photo' => 'nullable|mimes:jpeg,bmp,png',
            'opis' => 'required',
        ]);

        $team = new Team;
        $team->user_id = auth()->user()->id;

        $team->title = $request->name;
        $team->text = $request->opis;

        if($request->photo){
            $file = $request->photo;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/team/';

            \Storage::put($path, $file);

            $pathThumbnail = $file->hashName('public/team/thumb');
            $thumbnail = \Image::make($file);
            $thumb = $thumbnail->widen(600, function ($constraint) {
                                    $constraint->upsize();
                                })->encode('jpg', 95);
            \Storage::put($pathThumbnail, (string) $thumb->encode());

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $team->file_id = $storeFile->id;
        }

        $team->save();

        $team_member = new TeamMember;
        $team_member->team_id = $team->id;
        $team_member->user_id = auth()->user()->id;
        $team_member->save();

        return back()->with('success', 'Team został stworzony');
    }

    public function saveTitle(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:teams',
            'name' => 'required|string|max:255',
        ]);

        $team = Team::where('id', $request->id)->first();
        $team->title = $request->name;
        $team->save();

        return back()->with('success', 'Team został zapisany');
    }

    public function sendTeamRequest(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'team_id' => 'required|exists:teams,id',
        ]);

        $exist = TeamRequest::where('team_id', $request->team_id)->where('user_id', $request->user_id)->first();
        
        if($exist)
            return back()->with('info', 'Zaproszenie zostało już wcześniej wysłane');

        $team_request = new TeamRequest;
        $team_request->team_id = $request->team_id;
        $team_request->user_id = $request->user_id;
        $team_request->save();

        return back()->with('success', 'Zaproszenie zostało wysłane');
    }

    public function acceptRequest(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'team_id' => 'required|exists:teams,id',
        ]);

        $exist = TeamRequest::where('team_id', $request->team_id)->where('user_id', $request->user_id)->first();
        
        if(!$exist)
            return back()->with('danger', 'Zaproszenie nie istnieje');

        $team = Team::where('id', $request->team_id)->first();
        $user = \App\User::where('id', $request->user_id)->first();

        if($user->driver){
            if($team->drivers()->count() == 5)
                return back()->with('danger', 'W teamie znajduje się już 5 kierowców');
        }
        else{
            if($team->pilots()->count() == 5)
                return back()->with('danger', 'W teamie znajduje się już 5 pilotów');
        }

        $team_member = new TeamMember;
        $team_member->team_id = $request->team_id;
        $team_member->user_id = $request->user_id;
        $team_member->save();

        $exist->delete();

        return back()->with('success', 'Zaproszenie zostało zaakceptowane');
    }

    public function deleteRequest(Request $request)
    {
        $this->validate($request, [
            'request_id' => 'required|exists:team_requests,id',
        ]);

        $exist = TeamRequest::where('id', $request->request_id)->first();
        
        if(!$exist)
            return back()->with('danger', 'Zaproszenie nie istnieje');

        $exist->delete();

        return back()->with('success', 'Zaproszenie zostało usunięte');
    }

    public function leaveTeam(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:teams',
        ]);

        $team = Team::where('id', $request->id)->first();
        
        if(!$team)
            return back()->with('danger', 'Team nie istnieje');

        if(auth()->user()->team_admin())
            $team->user_id = $request->admin;

        TeamMember::where('team_id', $team->id)->where('user_id', auth()->user()->id)->delete();

        $team->save();

        return back()->with('success', 'Opuściłeś team');
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:teams',
            'photo' => 'nullable|mimes:jpeg,bmp,png',
        ]);

        $team = Team::where('id', $request->id)->first();
        $team->text = $request->opis;

        if($request->photo){
            $photo = \App\File::where('id',$team->file_id)->first();

            if($photo){
                \Storage::delete('public/team/'.$photo->path);
                \Storage::delete('public/team/thumb/'.$photo->path);
                $photo->delete();
            }

            $file = $request->photo;
            $originalName = $file->getClientOriginalName();
            $name = $file->hashName();
            $path = 'public/team/';

            \Storage::put($path, $file);

            $pathThumbnail = $file->hashName('public/team/thumb');
            $thumbnail = \Image::make($file);
            $thumb = $thumbnail->widen(600, function ($constraint) {
                                    $constraint->upsize();
                                })->encode('jpg', 95);
            \Storage::put($pathThumbnail, (string) $thumb->encode());

            $storeFile = new \App\File();
            $storeFile->name = $originalName;
            $storeFile->path = $name;
            $storeFile->save();

            $team->file_id = $storeFile->id;
        }

        if($request->deletePhoto){
            $photo = \App\File::where('id',$team->file_id)->first();
            if($photo){
                \Storage::delete('public/team/'.$photo->path);
                \Storage::delete('public/team/thumb/'.$photo->path);
                $photo->delete();
            }

            $team->file_id = null;
        }

        $team->save();

        return back()->with('success', 'Team został zapisany');
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:teams',
        ]);

        $team = Team::where('id', $request->id)->first();
            
        if($team->file_id){
            $photo = \App\File::where('id',$team->file_id)->first();
            if($photo){
                \Storage::delete('public/team/'.$photo->path);
                \Storage::delete('public/team/thumb/'.$photo->path);
                $photo->delete();
            }
        }

        if($team->members->count()){
            foreach ($team->members as $member) {
                $member->delete();
            }
        }

        if($team->team_requests->count()){
            foreach ($team->team_requests as $req) {
                $req->delete();
            }
        }

        if($team->signs->count()){
            foreach ($team->signs as $sign) {
                $sign->team_id = null;
                $sign->save();
            }
        }

        $team->delete();
        return back()->with('success', 'Partner został usunięty');
    }
}
