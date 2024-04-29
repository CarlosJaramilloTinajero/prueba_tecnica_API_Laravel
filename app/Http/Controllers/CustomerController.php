<?php

namespace App\Http\Controllers;

use App\Helpers\HelpersLogs;
use App\Helpers\HelpersResponseApi;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{

    function index(string|null $search = null)
    {
        try {
            // Log de entrada
            HelpersLogs::setlogIn('Consulta de customers con el search: ' .  $search, 'info');

            // Query para los customers
            $query = Customer::query()->with(['region', 'commune'])->where('status', '=', 'A');

            // Si el search es verdadero, buscamos los registros por dni o email
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('dni', $search)
                        ->orWhere('email', $search);
                });
            }

            // Obtenmos los customers
            $customers = $query->get();

            return HelpersResponseApi::responseSuccessApi($customers->toArray());
        } catch (\Exception $e) {
            report($e);
            return HelpersResponseApi::responseWithServerInteralError();
        }
    }

    function store(Request $request)
    {
        try {
            // Log de entrada
            HelpersLogs::setlogIn('Creacion de customers request: ' .  json_encode($request->all()), 'info');

            // Creamos el customer
            $customer = Customer::create([
                'dni' => $request->dni,
                'id_reg' => $request->id_reg,
                'id_com' => $request->id_com,
                'email' => $request->email,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'date_reg' => now(),
                'status' => 'A'
            ]);

            // Si no se creo el customer
            if (!$customer) {
                return HelpersResponseApi::responseFailApiWithMessage('Error al crear el customer');
            }

            return HelpersResponseApi::responseSuccessApi($customer);
        } catch (\Exception $e) {
            report($e);
            return HelpersResponseApi::responseWithServerInteralError();
        }
    }

    function destroy(string $dni)
    {
        try {
            // Log de entrada
            HelpersLogs::setlogIn('Eliminar el customer con el dni: ' .  $dni, 'info');

            // Validamos que exista el customer por el dni, que este actvo o desactivo
            if (!Customer::whereIn('status', ['A', 'I'])->where('dni', $dni)->first()) return HelpersResponseApi::responseFailApiWithMessage('El customer no existe', 422);

            // Actualizamos el status a del customer a trash
            $udpated = Customer::whereIn('status', ['A', 'I'])->where('dni', $dni)->update([
                'status' => 'trash'
            ]);

            // si no se actualizo retornamos el mensaje de error
            if (!$udpated) return HelpersResponseApi::responseFailApiWithMessage('Error al eliminar el customer');

            // Si se elimino correctamente (no se elimina el registro, solo se actualiza la columna status a trash) el customer retornamos un responseSuccess
            return HelpersResponseApi::responseSuccessApi();
        } catch (\Exception $e) {
            report($e);
            return HelpersResponseApi::responseWithServerInteralError();
        }
    }
}
