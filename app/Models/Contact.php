<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contact extends Model
{
    protected $fillable = ['name', 'tel', 'notes'];
    use HasFactory;

    public function read()
    {
        return $this->hasOne(Read::class);
    }
    
    public function getIsUnreadAttribute() //is_unread
    {
        return $this->updated_at > $this->read?->read_at;
    }
}
