<?php

namespace gift\app\models;

class Categorie extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
    public $keyType = 'int';

    public function prestations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Prestation::class, 'cat_id');
    }

}