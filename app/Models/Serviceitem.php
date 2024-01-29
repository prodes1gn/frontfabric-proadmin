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

class Serviceitem extends Model implements TranslatableContract, HasMedia, Editable {

    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;
    use Translatable;
    use EditableTrait;

    protected $table = 'serviceitems';
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
            #CRUD-NEW-LANG-FIELD




    ];

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')->fit(Manipulations::FIT_MAX, Setting::get('gallery_thumb_size'), Setting::get('gallery_thumb_size'));
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_MAX, Setting::get('gallery_preview_size'), Setting::get('gallery_preview_size'));
    }

    // #CRUD-FIELD-SEOIMAGE
    public function getSeoimageAttribute() {
        if (!request()->lang) {
            request()->lang = config('translatable.locale');
        }
        $file = $this->getMedia('seoimage-' . request()->lang)->last();
        if ($file) {
            if (!File::exists($file->getPath())) {
                $file = null;
            }
        } else {
            $file = null;
        }

        return $file;
    }
    
    #CRUD-NEW-RELATION
}
