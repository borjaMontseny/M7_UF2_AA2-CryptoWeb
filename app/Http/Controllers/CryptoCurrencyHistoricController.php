<?php

namespace App\Http\Controllers;

use App\Models\CryptoCurrencyHistoric;
use App\Http\Requests\StoreCryptoCurrencyHistoricRequest;
use App\Http\Requests\UpdateCryptoCurrencyHistoricRequest;

class CryptoCurrencyHistoricController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCryptoCurrencyHistoricRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($cryptocurrency)
    {
        try {
            $cryptoCurrency = CryptoCurrencyHistoric::where('slug', $cryptocurrency)->firstOrFail();
            $historialArray = json_decode($cryptoCurrency->historial, true);
            return view('history', compact('cryptoCurrency', 'historialArray'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Criptomoneda no encontrada, muestra la página personalizada
            return view('history-not-found');
        }
    }
       

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CryptoCurrencyHistoric $cryptoCurrencyHistoric)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCryptoCurrencyHistoricRequest $request, CryptoCurrencyHistoric $cryptoCurrencyHistoric)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CryptoCurrencyHistoric $cryptoCurrencyHistoric)
    {
        //
    }
}
