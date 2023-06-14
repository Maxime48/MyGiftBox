<?php

namespace gift\app\services\box;

use gift\app\models\Box;
use Ramsey\Uuid\Uuid;

class BoxService 
{

    public static function createEmptyBox(array $data) : Box
    {
        // Check for required fields
        if (!isset($data['libelle']) || !isset($data['description'])) {
            throw new \Exception("Données manquantes pour créer la box");
        }

        // Sanitize the data
        $libelle = htmlspecialchars($data['libelle'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8');

        // Create the new Box object
        $box = new Box();

        $box->libelle = $libelle;
        $box->description = $description;
        $box->id = Uuid::uuid4()->toString();
        $box->statut = Box::CREATED;
        $box->kdo = isset($data['kdo']) ? htmlspecialchars($data['kdo'], ENT_QUOTES, 'UTF-8') : [];
        $box->message_kdo = isset($data['message_kdo']) ? htmlspecialchars($data['message_kdo'], ENT_QUOTES, 'UTF-8') : "";
        $box->token = base64_encode(random_bytes(32));
        $box->montant = 0;

        $box->save();

        return $box;
    }

}