<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use SebastianBergmann\Environment\Console;

class ExploreController extends Controller
{
    public function searchRecent(Request $request)
    {

        return view('explore.index');
    }
}
