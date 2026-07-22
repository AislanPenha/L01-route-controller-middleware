<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MasterController extends Controller
{
    //type declarations
    public function initMethod(): string
    {
        return "Hello World";
    }

    public function initMethod2(): void
    {
        echo "Hello World"; 
    }

    public function viewPage(): View
    {
        return view('welcome');
    }

    // Chamando a função do Controller
    public function teste(string $value): void
    {
        echo "A string final é: " . $this->cleanUpperCaseString($value);
    }

}
