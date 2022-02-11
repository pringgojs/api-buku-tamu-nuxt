<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        // header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // header("Access-Control-Allow-Headers: Authorization");

        $guests = Guest::orderBy('created_at', 'desc')->get();
        return response()->json($guests);
        
    }

    public function store(Request $request)
    {
        
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // header("Access-Control-Allow-Headers: Authorization");
        
        $image = $request->avatar;
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        \File::put(public_path(). '/upload/' . $imageName, base64_decode($image));

        $model = new Guest();
        $model->name = $request->name;
        $model->phone = $request->phone;
        $model->institution = $request->institution;
        $model->avatar = url('/upload/'.$imageName);
        $model->save();

        $guests = Guest::orderBy('created_at', 'desc')->get(); 
        return response()->json($guests);

        
    }
    
}
