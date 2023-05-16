<?php

//exercice 2 : connexion à la base de données
//On réalise maintenant la connexion à la base de données. Dans un premier temps, on
//traite les fonctionnalités liées aux 3 premières routes concernant l'affichage des catégories
//et des prestations.
//Les requêtes doivent être écrites en utilisant l'ORM et les modèles définis au TD1.
//Ces requêtes doivent être construites dans une classe nommée \gift\services\
//prestations\PrestationsService ; cette classe utilise les modèles dont elle a
//besoin pour réaliser les fonctionnalités.
//Elle propose l'interface suivante :
//public function getCategories(): array;
//public function getCategorieById(int $id): array;
//public function getPrestationById(string $id): array;
//public function getPrestationsbyCategorie(int $categ_id):array;
//Utiliser cette classe pour programmer les actions correspondants aux 3 routes du TD1.
//Ajouter une route pour obtenir les prestations d'une catégorie.
//Pour l'instant on se contente d'un affichage simpliste.

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