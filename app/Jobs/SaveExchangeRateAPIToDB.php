<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\APIs\ExchangeRateAPI;
use App\Models\Base;

class SaveExchangeRateAPIToDB implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     public $tries = 2;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(ExchangeRateAPI $api): void
    {
        try{
            $this->saveData($api->fetch());
        }
        catch(\Exception $ex)
        {
            throw new \Exception('Job Failed!');
        }
    }

    /*
    * Check if base currency exisits with certian timestamp before attempting to update DB
    */
    private function saveData($response)
    {
         $date = new \DateTime();
         $baseCurrency = Base::where('currency', $response->base)
                            ->where('generated_at', $date->setTimestamp($response->timestamp));                           
        if($baseCurrency->doesntexist())
        {
            return $this->createRates($response, $this->createBase($response));
        }
        else{
            \Log::info('Data Already exists');
            return;
        }
    }

    /*
    * Store in Base table
    */
    private function createBase($response)
    {
        $date = new \DateTime();
        return \App\Models\Base::create([
            'currency' => $response->base,
            'generated_at' => $date->setTimestamp($response->timestamp),

        ]); 
    } 

    /*
    * Store in Rates table
    */
    private function createRates($response, $base)
    {
        foreach ($response->rates as $key => $value)
        {
           $rate = $base->rates()->create([
                'currency' => $key,
                'amount' => $value,
            ]);
        }
        return;
    }
    
    
}
