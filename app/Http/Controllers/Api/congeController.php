<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCongeRequest;
use App\Models\Conge;
use App\Services\CongeService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CongeController extends Controller
{
    use AuthorizesRequests;

    // Employé : mes demandes
    public function index(Request $request)
    {
        $this->authorize('viewAny', Conge::class);

        $service = new CongeService();

        $conges = $service->mesDemandes($request->user());

        return response()->json([
            'conges' => $conges
        ]);
    }

    // Employé : créer une demande
    public function store(StoreCongeRequest $request)
    {
        $this->authorize('create', Conge::class);

        $service = new CongeService();

        $conge = $service->creerDemande(
            $request->user(),
            $request->validated()
        );

        return response()->json([
            'message' => 'Demande créée avec succès',
            'conge' => $conge
        ], 201);
    }

    // Admin : toutes les demandes
    public function all()
    {
        $service = new CongeService();

        $conges = $service->toutesDemandes();

        return response()->json([
            'conges' => $conges
        ]);
    }

    // Admin : accepter ou refuser
    public function updateStatut(Request $request, Conge $conge)
    {
        $this->authorize('update', $conge);

        $request->validate([
            'status' => 'required|in:accepte,refuse'
        ]);

        $service = new CongeService();

        $conge = $service->changerStatut(
            $conge,
            $request->status
        );

        return response()->json([
            'message' => 'Statut modifié avec succès',
            'conge' => $conge
        ]);
    }
}