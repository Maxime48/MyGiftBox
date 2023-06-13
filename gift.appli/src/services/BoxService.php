<?php

namespace gift\app\services;

use gift\app\models\Box;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use gift\app\services\utils\CsrfService;

class BoxService 
{
    const STATUS_CREATED = 1;
    public static function createEmptyBox(array $data) : Box 
    {
        if (!isset($data['libelle'] ) || !isset($data['description'])) {
            throw new \Exception("Données manquantes pour créer la box");
        }

        $libelle = filter_var($data['libelle'], FILTER_UNSAFE_RAW);
        $description = filter_var($data['description'], FILTER_UNSAFE_RAW);

        $box = new Box();

        $box->libelle = $libelle;
        $box->description = $description;
        $box->id = Uuid::uuid4()->toString();
        $box->statut = Box::CREATED;
        $box->kdos = [];
        $box->message_kdo = "";
        $box->token = "";
        $box->montant = 0;

        $box->save();

        return $box;

    }
}