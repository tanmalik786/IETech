<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['file_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function mediable() {
        return $this->morphTo();
    }
}
