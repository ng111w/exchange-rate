<?php
namespace App\APIs; 
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeRateAPI{

	/**
     * The Exchange rate API details.
     *
     * @var string
     */
    private $url; 
    private $symbols;
    private $api;
    
    public function __construct()
	{  
		$this->url =  env('EXCHANGE_RATE_URL', 'https://openexchangerates.org/api/latest.json');
		$this->api =  env('EXCHANGE_RATE_API', 'e0a61dc3cbb745f88917d12ef37378d4');
		$this->symbols =   env('EXCHANGE_RATE_SYMBOLS', 'GBP,EUR,AED,CAD,STD,NGN,JPY,RUB,AUD,ZWL');
		
	}

    public function fetch()
    {
    	try{
	    	$response = Http::get($this->url.'?app_id='.$this->api.'&symbols='.$this->symbols);

	        if($response->ok())
	        {
	        	Log::info("API access successful!");
	            return $response = json_decode($response);  
	        }
	        else{
	            Log::info('API access failed!');
	            return 'no response';
	        }
	    }
	    catch(\Exception $ex)
	    {
	    	\Log::info("Error in accessing API => " . $ex->getMessage());
	    }
        
    }
}














?>