<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NetWorkController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $filleuls = $user->filleuls();
        dd($filleuls);

        return view('modules.network.index', [
            'filleuls' => $filleuls,
        ]);
    }
}
