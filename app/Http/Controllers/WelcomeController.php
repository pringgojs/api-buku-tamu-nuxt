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
}
