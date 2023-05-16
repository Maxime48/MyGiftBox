<?php

namespace gift\app\services;

use gift\app\models\Categorie;

class CategoriesService
{

    public function getCategories(): array
    {
        return Categorie::all()->toArray();
    }

    public function getCategorieById(int $id): array
    {
        $categorie = Categorie::find($id);
        if ($categorie == null) {
            return [];
        } else {
            return $categorie->toArray();
        }
    }

}