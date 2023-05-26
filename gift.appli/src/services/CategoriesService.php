<?php

namespace gift\app\prestation;

use gift\app\models\Categorie;
use gift\app\services\prestation\CategorieNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriesService
{

    public static function getCategories(): array
    {
        return Categorie::all()->toArray();
    }

    public static function getCategorieById(int $id): array
    {
        try {
            return Categorie::findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new CategorieNotFoundException("Catégorie inconnue: ". $id);
        }
    }

}