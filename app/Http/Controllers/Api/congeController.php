<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCongeRequest;
use App\Services\CongeService;
use App\Models\Conge;
use Illuminate\Http\Request;

class congeController extends Controller
{
    public function store(StoreCongeRequest $request, CongeService $service)
    {
        $conge = $service->create(
            $request->user(),
            $request->validated()
        );

        return response()->json([
            'message' => 'Demande crée avec succès',
            'conge' => $conge,
        ], 201);
    }

}
