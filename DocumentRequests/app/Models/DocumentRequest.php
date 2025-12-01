<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'last_name',
        'first_name',
        'document_type',
        'date_requested',
        'status',
    ];

    protected $casts = [
        'date_requested' => 'datetime',
    ];

    /**
     * Get the user that owns the document request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
