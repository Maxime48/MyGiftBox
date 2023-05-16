<?php

namespace gift\app\services;

use gift\app\models\Categorie;
use gift\app\models\Prestation;

class PrestationsService
{

    public function getPrestationById(string $id): array
    {
        $prestation = Prestation::find($id);
        if ($prestation == null) {
            return [];
        } else {
            return $prestation->toArray();
        }
    }

    public function getPrestationsByCategorie(int $categ_id): array
    {
        $prestations = Categorie::find($categ_id)->prestations()->get();
        if ($prestations == null) {
            return [];
        } else {
            return $prestations->toArray();
        }
    }

}