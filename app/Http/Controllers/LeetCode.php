<?php

namespace App\Http\Controllers;

use App\Enums\Jokenpo;
use Spatie\Browsershot\Browsershot;

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

    public function findDuplicate(array $nums)
    {
//        $count = array_count_values($nums);
//
//        $arrayComValoresDuplicados = [];
//
//        foreach ($count as $key => $value) {
//            if ($value > 1) {
//                $arrayComValoresDuplicados[] = [
//                    $key => $value
//                ];
//            }
//        }
//
//        foreach ($arrayComValoresDuplicados as $value ) {
//            return array_key_first($value);
//        }

        $count = array_count_values($nums);

        foreach ($count as $key => $value) {
            if ($value > 1) {
                return $key;
            }
        }
    }


    public function render()
    {
        $array = [
            'findDuplicate' => [
                'result' => $this->findDuplicate([1,3,4,2,2]),
                'params' => [1,3,4,2,2]
            ],
            'isPowerOfTwo' => [
                'result' => $this->isPowerOfTwo(5),
                'params' => [5]
            ],
            'jokenpo' => [
                'result' => $this->jokenpo(Jokenpo::TESOURA->value, Jokenpo::PAPEL->value),
                'params' => [Jokenpo::TESOURA->value, Jokenpo::PAPEL->value]
            ],
        ];

        return view('welcome', ['exercicios' => $array]);
    }


    public function downloadProposalPdf()
    {

        $html = view('pdf.teste-pdf')->render();

        $pdfBytes = Browsershot::html(mb_convert_encoding($html, 'UTF-8', 'UTF-8'))
            ->setOption('executablePath', '/usr/bin/google-chrome')
            ->setOption('printBackground', true)
            ->showBackground()
            ->setDelay(500)
            ->format('A2')
            ->showBrowserHeaderAndFooter()
            ->pdf();

        return response()->streamDownload(
            fn() => print($pdfBytes),
            "teste.pdf",
            ['Content-Type' => 'application/pdf']);
        }
}
