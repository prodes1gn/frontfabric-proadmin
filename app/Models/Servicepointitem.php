<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;
use JanisKelemen\Setting\Facades\Setting;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Dotlogics\Grapesjs\App\Contracts\Editable;
use Illuminate\Support\Facades\File;

class Servicepointitem extends Model implements TranslatableContract, HasMedia, Editable {

    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    use EditableTrait;

    protected $table = 'servicepointitems';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'order',
        'created_at',
        'updated_at',
        'deleted_at',
            #CRUD-NEW-FIELD
    ];
    public $translatedAttributes = [
        'name',
                    #CRUD-FIELD-TEXT-START
        'text',
            #CRUD-FIELD-TEXT-END
            #CRUD-NEW-LANG-FIELD

    ];

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')->fit(Manipulations::FIT_MAX, Setting::get('gallery_thumb_size'), Setting::get('gallery_thumb_size'));
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_MAX, Setting::get('gallery_preview_size'), Setting::get('gallery_preview_size'));
    }

    #CRUD-NEW-RELATION
}
