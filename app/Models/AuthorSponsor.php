<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthorSponsor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'createdby',
        'updatedby',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'createdby' => 'integer',
        'updatedby' => 'integer',
    ];

    public function createdby(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function updatedby(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
