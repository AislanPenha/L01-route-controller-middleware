<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // remover os espaços em branco no ínicio e fim de uma string
    // converter a string para uppercase (maiúscula)
    public function cleanUpperCaseString(string $str): string
    {
        return strtoupper(trim($str));
    }
}
