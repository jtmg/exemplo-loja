<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_produto extends Model
{
    use HasFactory;
    
    protected $table = "tipo_produto";
    
    public function products(){
        return $this->hasMany(Product::class, "tipo_produto_id","id");
    }
}
