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
        'final_price_netto',
        'final_price_vat',
        'final_price_brutto',
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->HasMany(Product::class, 'vat_id');
    }
}
