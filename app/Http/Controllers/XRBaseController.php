<?php

namespace App\Http\Controllers;
use App\Models\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class XRBaseController extends Controller
{
   
    public function fetchInsert(){
           
        $date = new \DateTime();
        // $timeStampDate = $date->setTimestamp(1674863974);
        // print_r($timeStampDate->format('Y-m-d H:i:s'));


        // $dt = \Carbon\Carbon::now();
        // $dt->setTimestamp($timestamp_string);
        // print_r($dt->format("Y-m"));

        // print_r($this->url.'?app_id='.$this->api.'&symbols='.$this->symbols);
        // dd();

      
        
    }

    public function index(Request $request)
    {

    }
}
