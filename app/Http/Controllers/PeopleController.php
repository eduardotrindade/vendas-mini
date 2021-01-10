<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleRequest;
use App\Models\People;
use App\Services\PeopleService;

class PeopleController extends Controller
{
    private PeopleService $peopleService;

    public function __construct(PeopleService $peopleService)
    {
        $this->peopleService = $peopleService;
    }

    public function index()
    {
        return People::paginate();
    }

    public function store(PeopleRequest $request)
    {
        return $this->peopleService->insert($request->validated());
    }

    public function show(People $people)
    {
        return $people;
    }
}
