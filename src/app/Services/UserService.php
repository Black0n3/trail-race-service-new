<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    public function checkUserExists($userId)
    {
        try {
            User::findOrFail($userId);
            return true;
        } catch (ModelNotFoundException $exception) {
            return false;
        }
    }
}
