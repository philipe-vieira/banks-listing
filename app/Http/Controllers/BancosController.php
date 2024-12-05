<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use Illuminate\Http\Request;

class BancosController extends Controller
{
    public function index(Request $req)
    {
        $perPage = $req->get('perPage', 15);

        return Bancos::paginate($perPage);
    }

    public function show(int $codigo)
    {
        $banco = Bancos::where('codigo', $codigo)->first();

        if (!$banco) return response()->json(['error' => true, 'msg' => 'Banco não encontrado']);
        return $banco;
    }
}
