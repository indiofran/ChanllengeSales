<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_name',
        'buyer_dni',
        'total_price',
        'car_id',
        'price_per_installment',
    ];

    public function getTotalPriceInDecimalAttribute()
    {
        return $this->total_price / 100;
    }
    public function getPricePerInstallmentInDecimalAttribute()
    {
        return $this->price_per_installment / 100;
    }

    public function setTotalPriceAttribute($value)
    {
        $this->attributes['total_price'] = $value * 100;  // Convertir a centavos
    }

    public function setPricePerInstallmentAttribute($value)
    {
        $this->attributes['price_per_installment'] = $value * 100;  // Convertir a centavos
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
}
