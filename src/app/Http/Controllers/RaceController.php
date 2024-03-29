<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Race;

use App\Services\RaceService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function Laravel\Prompts\error;

class RaceController extends Controller
{
    public function index()
    {
        $races = Race::orderby('created_at', 'asc')->get();
        return view('sites.app.race.index',compact('races'));
    }

    public function newApplication($raceId)
    {
        $race = Race::findorFail($raceId);

        return view('sites.app.race.new-application', compact('race'));
    }

    public function applicationSave(StoreApplicationRequest $request, UserService $userService, RaceService $raceService)
    {
        // Check if user exist in DB
        if (!$userService->checkUserExists($request->input('user_id'))) {
            return abort(404,'User not found');
        }

        // Check if race exist in DB
        if (!$raceService->checkRaceExists($request->input('race_id'))) {
            return abort(404,'Race not found');
        }


        $application = new Application();
        $application->first_name = $request->input('first_name');
        $application->last_name = $request->input('last_name');
        $application->race_id = $request->input('race_id');
        $application->user_id = $request->input('user_id');
        $application->club = $request->input('club');
        $application->save();

        return redirect()->route('app.applications.my')->with(['message' => 'Application created successfully']);

    }
}
