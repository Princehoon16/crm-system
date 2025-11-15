<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'product_service', 
        'amount',
        'sale_date',
        'status',
        'sales_person_id',
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'sale_date' => 'datetime'
    ];

    // Relationship with sales person
    public function salesPerson()
    {
        return $this->belongsTo(User::class, 'sales_person_id');
    }

    // Scopes for easy querying
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('sale_date', now()->month)
                    ->whereYear('sale_date', now()->year);
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('sale_date', now()->year);
    }
}