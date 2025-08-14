<?php

namespace App\Http\Controllers;

use App\Enums\Jokenpo;

class LeetCode extends Controller
{
    public function isPowerOfTwo($n)
    {
        if ($n <= 0) {
            return 'false';
        }

        $calc = log($n, 2);

        $isInteger = abs($calc - round($calc)) < 1e-10;

        if ($isInteger) {
            return 'true';
        }

        return 'false';
    }

    public function jokenpo($mao1,$mao2)
    {
        if ($mao1 === $mao2) {
            return 'EMPATE';
        }

        return match (true) {
            $mao1 === Jokenpo::PEDRA->value && $mao2 === Jokenpo::TESOURA->value => 'Parametro 1 VENCEU',
            $mao1 === Jokenpo::TESOURA->value && $mao2 === Jokenpo::PAPEL->value => 'Parametro 1 VENCEU',
            $mao1 === Jokenpo::PAPEL->value && $mao2 === Jokenpo::PEDRA->value => 'Parametro 1 VENCEU',
            default => 'Parametro 2 VENCEU'
        };
    }



    public function render()
    {
        $array = [
            'jokenpo' => [
                'result' => $this->jokenpo(Jokenpo::TESOURA->value, Jokenpo::PAPEL->value),
                'params' => [Jokenpo::TESOURA->value, Jokenpo::PAPEL->value]
            ],
            'isPowerOfTwo' => [
                'result' => $this->isPowerOfTwo(5),
                'params' => [5]
            ]
        ];

        return view('welcome', ['exercicios' => $array]);
    }
}
