<?php

namespace gift\app\services;

use gift\app\models\Categorie;
use gift\app\models\Prestation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use gift\app\services\utils\CsrfService;

class PrestationsService
{

    public static function getPrestationById(string $id): array
    {
        try {
            return Prestation::findOrFail($id)->toArray();
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException("Prestation inconnue: ". $id);
        }
    }

    public static function getPrestationsByCategorie(int $categ_id): array
    {
        try {
            return Categorie::findOrFail($categ_id)->prestations()->get()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new PrestationNotFoundException("Catégorie inconnue ou sans prestation: ". $categ_id);
        }
    }

    public static function createCategorie($data) {
        // Vérifie le token CSRF
        CsrfService::checkToken($data['csrf_token']);

        // Vérifie la présence des données nécessaires
        if (!isset($data['libelle']) || !isset($data['description'])) {
            throw new \Exception("Données manquantes pour créer la catégorie");
        }

        // Filtre les données pour se prémunir des injections XSS
        $libelle = filter_var($data['libelle'], FILTER_UNSAFE_RAW);
        $description = filter_var($data['description'], FILTER_UNSAFE_RAW);

        // Vérifie si les données filtrées sont identiques aux données originales
        if ($libelle !== $data['libelle'] || $description !== $data['description']) {
            throw new \Exception("Données suspectes pour créer la catégorie");
        }

        // Crée une nouvelle instance de la catégorie
        $categorie = new Categorie();
        $categorie->libelle = $libelle;
        $categorie->description = $description;

        // Enregistre la catégorie dans la base de données
        $categorie->save();

        // Retourne la catégorie créée
        return $categorie;
    }

}