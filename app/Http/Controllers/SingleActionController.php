<?php
// php artisan make:controller SingleActionController --invokable

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleActionController extends Controller
{
    // só tera um método publico (__invoke), mas não impede de ter privados
    public function __invoke(Request $request): void
    {
        echo 'Single Action Controller';
        echo "</br>";
        echo $this->privateMethod();
    }

    private function privateMethod(): string {
        return 'Private Method';
    }
}
