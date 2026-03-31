<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'shop_name','shop_slug','shop_logo','shop_description','vendor_status',
        'is_active','wallet_balance','commission_rate','tax_id','business_license',
        'business_document','email','phone','address','city','state','country','postal_code',
        'featured','rating','total_products','deleted_at',
    ];

    protected $hidden = [
        'business_document',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'featured' => 'boolean',
        'wallet_balance' => 'decimal:2',
        'commission_rate' => 'decimal:2',
    ];

    // One Vendor can have many Users (staff, owner)
    public function user()
    {
        return $this->hasMany(User::class, 'vendor_id');
    }
}
