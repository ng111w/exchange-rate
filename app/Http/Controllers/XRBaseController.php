<?php

namespace App\Http\Controllers;
use App\Models\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class XRBaseController extends Controller
{
    private $symbols = 'GBP,EUR,AED,CAD,STD,NGN,JPY,RUB,AUD,ZWL';
    

    public function fetchInsert(){
           
        $date = new \DateTime();
        // $timeStampDate = $date->setTimestamp(1674863974);
        // print_r($timeStampDate->format('Y-m-d H:i:s'));


        // $dt = \Carbon\Carbon::now();
        // $dt->setTimestamp($timestamp_string);
        // print_r($dt->format("Y-m"));


           
        $response = Http::get("https://openexchangerates.org/api/historical/2023-01-27.json?app_id=e0a61dc3cbb745f88917d12ef37378d4&symbols=$this->symbols");

            if($response->ok())
            {
                $response = json_decode($response);  
            }
            else{
                return 'no response';
            }

            $date = new \DateTime();
            $date->setTimestamp($response->timestamp);
            

            $base = Base::create([
                'currency' => $response->base,
                'generated_at' => $date->setTimestamp($response->timestamp),

            ]);
            foreach ($response->rates as $key => $value)
            {
               $rate = $base->rates()->create([
                    'currency' => $key,
                    'amount' => $value,
                ]);
            }
            print_r( "<hr/>" );
            return $response;
    }

    public function index(Request $request)
    {
        return ;
    }
}
