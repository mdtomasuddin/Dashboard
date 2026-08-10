<?php

namespace App\Models;

use Illuminate\Console\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded([])]
#[Hidden(['updated_at', 'created_at'])]
class FAQ extends Model
{
    // table name
    protected $table = 'f_a_q_s';

    // The attributes that should be cast.
    protected function casts(): array
    {
        return [
            'id'         => 'integer',
            'question'   => 'string',
            'answer'     => 'string',
            'status'     => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Relationships and other model methods can be added here
}





