<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBiodata;
use Illuminate\Support\Facades\Schema;

class WelcomeController extends Controller
{
    public function index()
    {
        $biodata = new MasterBiodata;

        $operators = ['=', '!=', 'like', 'contains', '>=', '<='];
        $view = view('welcome');
        $view->columns = Schema::getColumnListing($biodata->getTable());
        $view->operators = $operators;



        return $view;
    }

    public function search(Request $request)
    {
        // dd($request->all());
        $search = MasterBiodata::search($request->all())->paginate(100);
        return view('search', ['results' => $search]);
        dd($search);
    }

    public function kominfo()
    {
        $instansi = 'DINAS KOMUNIKASI';
        $fungsional = MasterBiodata::joinJabFungsional()
            ->where(function ($q) use ($instansi) {
                $q->where('rwyt_jab_fungsional.instansi', 'like', '%'.$instansi.'%')
                ->where('rwyt_jab_fungsional.aktif', 'Y');
            })
            ->select('biodata.*')
            ->get();
        $pelaksana = MasterBiodata::joinJabPelaksana()
            ->where(function ($q) use ($instansi) {
                $q->where('rwyt_jab_pelaksana.instansi', 'like', '%'.$instansi.'%')
                ->where('rwyt_jab_pelaksana.aktif', 'Y');
            })
            ->select('biodata.*')
            ->get();
        $struktural = MasterBiodata::joinJabStruktural()
            ->where(function ($q) use ($instansi) {
                $q->where('rwyt_jab_struktural.instansi', 'like', '%'.$instansi.'%')
                ->where('rwyt_jab_struktural.aktif', 'Y');
            })
            ->select('biodata.*')
            ->get();
        
        return view('kominfo', ['fungsional' => $fungsional, 'struktural' => $struktural, 'pelaksana' => $pelaksana]);
    }

    public function getFile(Request $request)
    {
        info($request->all());

        $file = base64_decode($request['base64file']);
        $path = public_path() . '/upload/test.jpeg';
        $success = file_put_contents($path, $file);
        
        
        return "sucess";
    }
}
