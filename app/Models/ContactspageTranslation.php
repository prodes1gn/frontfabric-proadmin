<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactspageTranslation extends Model {

    public $table = 'contactspages_translations';
    protected $fillable = [
        'name',
                    #CRUD-FIELD-SLUG-START
        'slug',
            #CRUD-FIELD-SLUG-END
                    #CRUD-FIELD-SEOTITLE-START
        'seotitle',
            #CRUD-FIELD-SEOTITLE-END
                    #CRUD-FIELD-SEODESCRIPTION-START
        'seodescription',
            #CRUD-FIELD-SEODESCRIPTION-END
                    #CRUD-FIELD-SEOTYPE-START
        'seotype',
            #CRUD-FIELD-SEOTYPE-END
                    #CRUD-FIELD-TEXT-START
        'text',
            #CRUD-FIELD-TEXT-END
                    #CRUD-FIELD-EMAIL-START
        'email',
            #CRUD-FIELD-EMAIL-END
                    #CRUD-FIELD-PHONE-START
        'phone',
            #CRUD-FIELD-PHONE-END
                    #CRUD-FIELD-CALENDY-START
        'calendy',
            #CRUD-FIELD-CALENDY-END
            #CRUD-NEW-LANG-FIELD








    ];
    public static $searchable = [
        'name',
    ];
    public $timestamps = false;

}
