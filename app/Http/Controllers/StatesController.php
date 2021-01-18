<?php

namespace App\Http\Controllers;

use App\Models\State;

class StatesController extends Controller
{
    public function index()
    {
        return State::query()->orderBy('name')->get();
    }

    public function showCities(State $state)
    {
        return $state->cities;
    }
}
