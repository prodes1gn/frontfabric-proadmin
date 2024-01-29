<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleTranslation extends Model {

    public $table = 'core_roles_translations';
    protected $fillable = [
        'title',
    ];
    public static $searchable = [
        'title',
    ];
    public $timestamps = false;

}
