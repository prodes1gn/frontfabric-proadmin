<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValuesitemTranslation extends Model {

    public $table = 'valuesitems_translations';
    protected $fillable = [
        'name',
            #CRUD-NEW-LANG-FIELD
    ];
    public static $searchable = [
        'name',
    ];
    public $timestamps = false;

}
