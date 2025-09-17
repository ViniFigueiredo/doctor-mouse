<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        Produto::create([
            'nome' => 'Mouse Gamer Sem Fio Logitech G305 LIGHTSPEED',
            'descricao' => 'Mouse gamer sem fio com tecnologia LIGHTSPEED, sensor HERO de alta precisão e até 250 horas de bateria.',
            'preco' => 199.90,
            'estoque' => 50,
            'imagem' => 'images/produtos/Mouse Gamer Sem Fio Logitech G305 LIGHTSPEED .jpg',
            'categoria' => 'Mouse',
        ]);

        Produto::create([
            'nome' => 'MousePad Gamer Redragon Flick XL',
            'descricao' => 'MousePad gamer tamanho XL com superfície microtexturizada e base emborrachada para máxima estabilidade.',
            'preco' => 59.90,
            'estoque' => 100,
            'imagem' => 'images/produtos/Mousepad Gamer Redragon Flick XL.jpg',
            'categoria' => 'MousePad',
        ]);

        Produto::create([
            'nome' => 'Teclado Mecânico Redragon Kumara',
            'descricao' => 'Teclado mecânico compacto Redragon Kumara com switches Outemu Blue e iluminação RGB personalizável.',
            'preco' => 399.90,
            'estoque' => 30,
            'imagem' => 'images/produtos/redragon_kumara.jpg',
            'categoria' => 'Teclado',
        ]);

        Produto::create([
            'nome' => 'Mouse Razer DeathAdder Essential',
            'descricao' => 'Mouse Razer DeathAdder Essential com design ergonômico clássico, sensor óptico de 6400 DPI e switches mecânicos duráveis.',
            'preco' => 249.90,
            'estoque' => 40,
            'imagem' => 'images/produtos/razer-mouse.jpg',
            'categoria' => 'Mouse',
        ]);
        Produto::create([
            'nome' => 'Mouse pad de vidro profissional para jogos Logitech G502/G PRO/G703',
            'descricao' => 'Mouse pad rígido de vidro temperado com superfície ultralisa para máximo desempenho em jogos competitivos.',
            'preco' => 599.90,
            'estoque' => 20,
            'imagem' => 'images/produtos/mousepad_vidro_logitech.jpg',
            'categoria' => 'MousePad',
        ]);
    }
}
