<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBiodata;

class ApiController extends Controller
{
    public function getPegawaiByNip()
    {
        $nip = '199506142020121004';
        return MasterBiodata::whereNipBaru($nip)->first();
    }

    public function get(Type $var = null)
    {
        # code...
    }
}
