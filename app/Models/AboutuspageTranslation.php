<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutuspageTranslation extends Model {

    public $table = 'aboutuspages_translations';
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
                    #CRUD-FIELD-STORY-START
        'story',
            #CRUD-FIELD-STORY-END
                    #CRUD-FIELD-WHYUS-START
        'whyus',
            #CRUD-FIELD-WHYUS-END
            #CRUD-NEW-LANG-FIELD







    ];
    public static $searchable = [
        'name',
    ];
    public $timestamps = false;

}
