<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleRequest;
use App\Http\Resources\PeopleResource;
use App\Models\People;
use App\Models\Profile;
use App\Services\PeopleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    private PeopleService $peopleService;

    public function __construct(PeopleService $peopleService)
    {
        $this->peopleService = $peopleService;
    }

    public function index()
    {
        $results = People::query()
            ->where('is_active', '!=', 2)
            ->orderBy('is_active')
            ->orderBy('name')
            ->paginate();

        return PeopleResource::collection($results);
    }

    public function store(PeopleRequest $request)
    {
        return $this->peopleService->insert($request->validated());
    }

    public function show(People $people)
    {
        return PeopleResource::make($people);
    }

    public function update(People $people, PeopleRequest $request)
    {
        $people = $this->peopleService->update($people, $request->validated());

        return PeopleResource::make($people);
    }

    public function destroy(People $people)
    {
        $people->is_active = 2;
        $people->save();

        return response()->json(['message' => 'Representante removido']);
    }

    public function changeActive(People $people, Request $request)
    {
        $profileId = $request->get('profile_id');

        $people = $this->peopleService->changeActive($people, $profileId);

        return PeopleResource::make($people);
    }

    public function showDocumentNumber(Request $request)
    {
        try {
            $people = People::query()
                ->where('document_number', $request->get('documentNumber'))
                ->whereIn('profile_id', [Profile::MASTER, Profile::AFILIADO])
                ->where('is_active', true)
                ->firstOrFail();

            return PeopleResource::make($people);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'CPF/CNPJ não encontrado.'], 404);
        }
    }

    public function export()
    {
        $file = $this->peopleService->export();

        return response()->download($file);
    }
}
