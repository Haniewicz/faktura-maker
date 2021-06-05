<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'seller',
        'seller_nip',
        'seller_street',
        'seller_city',
        'seller_postcode',
        'client',
        'client_nip',
        'client_street',
        'client_city',
        'client_postcode',
        'final_price',
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->hasMany(Product:class);
    }
}
