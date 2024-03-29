<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRaceRequest;
use App\Http\Requests\UpdateRaceRequest;
use App\Http\Resources\RaceResource;
use App\Models\Race;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $races = Race::orderBy('created_at', 'asc')->paginate(100);
            return RaceResource::collection($races);
        } catch (\Exception $exception) {
            Log::error('An error occurred while getting a list: ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRaceRequest $request)
    {
        try {
            $race = new Race();
            $race->name = $request->input('name');
            $race->distance = $request->input('distance');
            $race->save();

            return new RaceResource($race, 201);
        } catch (\Exception $exception) {
            Log::error('An error occurred while creating a race: ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $race = Race::findOrFail($id);
            return new RaceResource($race, 200);
        } catch (\Exception $exception) {
            Log::error('An error occurred while showing a race: ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRaceRequest $request, $id)
    {
        try {
            $race = Race::findOrFail($id);
            $race->name = $request->input('name');
            $race->distance = $request->input('distance');
            $race->save();

            return response()->json(['message' => 'Race updated successfully'], Response::HTTP_OK);
            //return new RaceResource($race, 200);
        } catch (\Exception $exception) {
            Log::error('An error occurred while updating a race: ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $race = Race::findOrFail($id);
            $race->delete();

            return response()->json(['message' => 'Race deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            Log::error('An error occurred while deleting a race: ' . $exception->getMessage());
            return response()->json(['error' => 'Internal server error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
