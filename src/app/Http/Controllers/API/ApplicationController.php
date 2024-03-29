<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Services\RaceService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the application.
     */
    public function index()
    {
        try {
            $applications = Application::orderBy('created_at', 'asc')->paginate(100);
            return ApplicationResource::collection($applications);
        } catch (\Exception $exception) {
            Log::error('An error occurred while getting a list: ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicationRequest $request, UserService $userService, RaceService $raceService)
    {
        // Check if user exist in DB
        if (!$userService->checkUserExists($request->input('user_id'))) {
            return response()->json(['error' => 'User not found.'], Response::HTTP_NOT_FOUND);
        }

        // Check if race exist in DB
        if (!$raceService->checkRaceExists($request->input('race_id'))) {
            return response()->json(['error' => 'Race not found.'], Response::HTTP_NOT_FOUND);
        }

        try {
            $application = new Application();
            $application->first_name = $request->input('first_name');
            $application->last_name = $request->input('last_name');
            $application->race_id = $request->input('race_id');
            $application->user_id = $request->input('user_id');
            $application->club = $request->input('club');
            $application->save();

            return new ApplicationResource($application, 201);
        } catch (\Exception $exception) {
            Log::error('An error occurred while creating a application: ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified application.
     */
    public function show($id)
    {
        try {
            $application = Application::findOrFail($id);
            return new ApplicationResource($application);
        } catch (ModelNotFoundException $exception) {
            Log::info('Application not found: ' . $exception->getMessage());
            return response()->json(['error' => 'Application not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            Log::error('An error occurred while showing a application: ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $application = Application::findOrFail($id);
            $application->delete();
            return response()->json('Application deleted successfully');
        } catch (ModelNotFoundException $exception) {
            Log::info('Application not found: ' . $exception->getMessage());
            return response()->json(['error' => 'Application not found.'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            Log::info('An error occurred while deleting application ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
