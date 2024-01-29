<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ActivityLog extends Model {

    use HasFactory;

    // #SET TABLE NAME    
    protected $table = 'core_users_activity_log';
    // #SET COLUMNS
    protected $fillable = [
        'url',
        'ip',
        'type',
        'user_id',
        'updated_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
