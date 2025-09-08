<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CarwashController extends Controller
{
    /**
     * Recupera l'ultima scansione dall'API esterna dell'autolavaggio.
     */
    public function latestScan()
    {
        $baseUrl = config('services.carwash.base_url');
        $token   = config('services.carwash.token');

        try {
            $response = Http::withToken($token)
                ->get($baseUrl . '/scans', [
                    'limit'      => 1,
                    'order_by'   => 'id',
                    'sort_order' => 'DESC',
                ]);

            if ($response->successful()) {
                $data = $response->json();

                if (!empty($data['scans'][0])) {
                    return response()->json([
                        'success' => true,
                        'scan'    => $data['scans'][0],
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Nessuna scansione trovata',
                    ], 404);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Errore API esterna',
                    'status'  => $response->status(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Eccezione: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Aggiorna/patcha una scansione sull’API esterna.
     * Esempio: modificare confidence_threshold
     */
    public function updateScan(Request $request, $id)
    {
        $baseUrl = config('services.carwash.base_url');
        $token   = config('services.carwash.token');

        try {
            $response = Http::withToken($token)
                ->patch($baseUrl . '/scans/' . $id, $request->all());

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'updated' => $response->json(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Errore durante aggiornamento',
                    'status'  => $response->status(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Eccezione: ' . $e->getMessage(),
            ], 500);
        }
    }
}
