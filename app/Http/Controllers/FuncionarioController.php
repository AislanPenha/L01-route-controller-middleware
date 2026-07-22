<?php
// php artisan make:controller FuncionarioController --resource

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        echo 'Lista todos os funcionários';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        echo 'Exibe o formulário de cadastro';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "Exibe um funcionário específico: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        echo "Exibe o formulário de edição(Funcionário): $id";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
