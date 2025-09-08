<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ScanController extends Controller
{
    private function client()
    {
        $client = Http::baseUrl(config('services.techlavaggio.base_url'))
                      ->acceptJson()
                      ->timeout(10);

        $token = config('services.techlavaggio.token');
        if (!empty($token)) {
            $client = $client->withToken($token);
        }
        return $client;
    }

    // GET /api/scans -> proxy con tutti i filtri/ordinamenti/paginazione
    public function index(Request $request)
    {
        $allowed = [
            'limit','page','order_by','sort_order',
            'min_cars','max_cars','min_trucks','max_trucks',
            'min_total','max_total','start_date','end_date','camera'
        ];
        $query = $request->only($allowed);
        $resp  = $this->client()->get('/api/scans', $query);

        return response()->json($resp->json(), $resp->status());
    }

    // GET /api/scans/latest -> ultima scansione (limit=1)
    public function latest(Request $request)
    {
        $query = array_filter([
            'limit'      => 1,
            'order_by'   => 'id',
            'sort_order' => 'DESC',
            'camera'     => $request->query('camera'),
        ], fn($v) => $v !== null && $v !== '');

        $resp = $this->client()->get('/api/scans', $query);
        return response()->json($resp->json(), $resp->status());
    }

    // PATCH /api/scans/{id} -> inoltra patch verso l'API esterna
    public function update(Request $request, $id)
    {
        $resp = $this->client()->patch("/api/scans/{$id}", $request->all());
        return response()->json($resp->json(), $resp->status());
    }
}
