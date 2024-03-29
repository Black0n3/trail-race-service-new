<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function myApplications()
    {
        return view('sites.app.application.my');

    }

    public function destroy($id)
    {

        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('app.applications.my')->with(['message' => 'Application deleted successfully']);

    }
}
