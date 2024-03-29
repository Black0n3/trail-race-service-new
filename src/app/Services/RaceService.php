<?php
namespace App\Services;

use App\Models\Race;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RaceService
{
    public function checkRaceExists($raceId)
    {
        try {
            Race::findOrFail($raceId);
            return true;
        } catch (ModelNotFoundException $exception) {
            return false;
        }
    }
}
