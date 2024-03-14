<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;


    protected $fillable = [
        'ordered',
        'delivered',
        'address',
        'status',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'order_by');
    }

    public function medications(): MorphMany
    {
        return $this->MorphMany(Medication::class,'id');
    }    


}
