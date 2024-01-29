<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends \JanisKelemen\Setting\EloquentStorage {

    protected $table = 'core_settings';

}