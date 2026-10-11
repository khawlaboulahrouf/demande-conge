<?php

namespace App\Services;

use App\Models\Conge;
use App\Models\User;

class CongeService 
{
    public function create(User $user, array $data):Conge
    {
        return $user->conges()->create([
            'date_debut' => $data['date_debut'],
            'date_fin' => $data['date_fin'],
            'motif' => $data['motif'],
            'statut' => 'en_cours',
        ]);
    }
}
