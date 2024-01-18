<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Base;

class SearchController extends Controller
{
    public function index(Request $request, Base $base)
    {
        $datetime = $base->pluck("generated_at", "id")->toArray();
        return view('search', [
            "datetime"  => $datetime,
        ]);       
    }

    public function search(Request $request, Base $base)
    {
        if(!is_numeric($request->id))
        {
            return redirect()->back()
                ->with('error_message', 'Not Valid. Select date')
                ->withInput(); 
        }
        
        if($base->where('id', $request->id)->exists())
        {
            $usd = $base->where('id', $request->id)->first();
            
            $datetime = $base->pluck("generated_at", "id")->toArray();
            return view('search-table', [
                "datetime"  => $datetime,
                "base" => $usd,
                "usd" => $usd->rates
            ]);
        }
        return redirect()->route("search")->with('error_message', 'Choose a date');
    }

}
