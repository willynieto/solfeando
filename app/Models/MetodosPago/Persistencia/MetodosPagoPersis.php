<?php

namespace App\Models\MetodosPago\Persistencia;

use App\Models\MetodosPago\MetodoPago;
use Illuminate\Http\Request;

class MetodosPagoPersis
{
    //Método para consultar todos los métodos de pago
    public function consultarMetodosPago()
    {
        $metodosPago = MetodoPago::all();
        return $metodosPago;
    }

    //Método para crear métodos de pago
    public function crearMetodoPago(Request $request)
    {
        MetodoPago::create([
            'medio_pago' => $request->medio_pago
        ]);
    }

    //Método para actualizar métodos de pago
    public function actualizarMetodoPago(Request $request, MetodoPago $metodoPago)
    {
        $metodoPago->update([
            'medio_pago' => $request->medio_pago
        ]);
    }

    //Método para borrar métodos de pago
    public function eliminarMetodoPago(MetodoPago $metodoPago)
    {
        $metodoPago->delete();
    }
}
