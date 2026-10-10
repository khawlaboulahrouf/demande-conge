<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conge;
use Illuminate\Http\Request;

class congeController extends Controller
{
    public function store(Request $request)
    {
        if($request->user()->role !== 'employe') {
            return response()->json([
                'message' => 'Accès interdit'
            ], 403);
        }

        $data = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string',
        ]);

        $conge = Conge::create([
            'user_id' => $request->user()->id,
            'date_debut' => $data['date_debut'],
            'date_fin' => $data['date_fin'],
            'motif' => $data['motif'],
            'statut' => 'en_cours',
        ]);
        return response()->json([
            'message' => 'Demande de congé crée avec succès',
            'conge' => $conge,
        ], 201);
    }
}
