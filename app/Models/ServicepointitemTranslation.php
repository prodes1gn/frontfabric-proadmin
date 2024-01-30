<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicepointitemTranslation extends Model {

    public $table = 'servicepointitems_translations';
    protected $fillable = [
        'name',
                    #CRUD-FIELD-TEXT-START
        'text',
            #CRUD-FIELD-TEXT-END
            #CRUD-NEW-LANG-FIELD

    ];
    public static $searchable = [
        'name',
    ];
    public $timestamps = false;

}
