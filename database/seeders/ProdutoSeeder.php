<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        Produto::create([
            'nome' => 'Mouse Gamer XYZ',
            'descricao' => 'Mouse com sensor de alta precisão e iluminação RGB.',
            'preco' => 199.90,
            'estoque' => 50,
            'imagem' => 'mouse_xyz.jpg',
            'categoria' => 'Mouse',
        ]);

        Produto::create([
            'nome' => 'MousePad Pro',
            'descricao' => 'MousePad grande, superfície anti-deslizante.',
            'preco' => 59.90,
            'estoque' => 100,
            'imagem' => 'mousepad_pro.jpg',
            'categoria' => 'MousePad',
        ]);

        Produto::create([
            'nome' => 'Teclado Mecânico ABC',
            'descricao' => 'Teclado mecânico com switches táteis e iluminação RGB.',
            'preco' => 399.90,
            'estoque' => 30,
            'imagem' => 'teclado_abc.jpg',
            'categoria' => 'Teclado',
        ]);
    }
}
