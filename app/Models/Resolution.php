<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Resolution extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'res_date',
        'res_no',
        'series',
        'subject',
        'author_id',
        'committee_in_charge',
        'file',
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
        'res_date' => 'date',
        'author_id' => 'integer',
        'createdby' => 'integer',
        'updatedby' => 'integer',
    ];

    protected static function booted(): void
    {
        static::deleted(function ($model) {
            if ($model instanceof Resolution) {
                Storage::disk('public')->delete($model->file);
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(AuthorSponsor::class);
    }

    public function createdby(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function updatedby(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
