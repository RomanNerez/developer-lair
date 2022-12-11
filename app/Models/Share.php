<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    protected $table = 'share';

    protected $fillable = [
        'uuid',
        'type',
        'file_name'
    ];
}
