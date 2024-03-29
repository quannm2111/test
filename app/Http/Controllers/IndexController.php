<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

 class IndexController
{
    public function __contruct()
    {

    }

    public function index() {
        $jsonFilePath = public_path('./data/dishes.json');
        $jsonData = file_get_contents($jsonFilePath);
        $data = json_decode($jsonData, true);
        return view('index', ['data' => $data['dishes']]);
    }

    public function submit(Request $request)
    {
        dd($request->all());
    }
}