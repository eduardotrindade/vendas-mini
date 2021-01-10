<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class ProfilesController extends Controller
{
    public function showProducts(Profile $profile)
    {
        return $profile->products;
    }
}
