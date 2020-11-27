<?php
namespace App\Http\Controllers;

use App\Models\App;

class AppController extends Controller
{
    public function list()
    {
        return App::all()->sortBy('app_name');
    }
}
