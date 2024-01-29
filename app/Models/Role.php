<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Role extends Model implements TranslatableContract {

    use SoftDeletes;
    use HasFactory;
    use Translatable;

    protected $table = 'core_roles';
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
    ];
    public $translatedAttributes = [
        'title',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'core_permission_role');
    }

    protected function serializeDate(DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

}
