<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'status',
    ];

    // Relacionamento: um item do carrinho pertence a um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
