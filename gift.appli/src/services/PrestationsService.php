<?php

namespace gift\app\services\services;

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PrestationsService
{

    public function getPrestationById(string $id): array
    {
        try {
            return Prestation::findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException("Prestation inconnue: ". $id);
        }
    }

    public function getPrestationsByCategorie(int $categ_id): array
    {
        try {
            return Categorie::findOrFail($categ_id)->prestations()->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException("Catégorie inconnue ou sans prestation: ". $categ_id);
        }
    }

}