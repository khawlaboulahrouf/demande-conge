<?php

namespace App\Services;

use App\Models\Conge;

class CongeService
{
    public function creerDemande($user, $data)
    {
        return Conge::create([
            'user_id' => $user->id,
            'date_debut' => $data['date_debut'],
            'date_fin' => $data['date_fin'],
            'motif' => $data['motif'],
            'status' => 'en_cours',
        ]);
    }

    public function mesDemandes($user)
    {
        return $user->conges;
    }

    public function toutesDemandes()
    {
        return Conge::with('user')->get();
    }

    public function changerStatut($conge, $status)
    {
        $conge->update(['status' => $status]);

        return $conge;
    }


}