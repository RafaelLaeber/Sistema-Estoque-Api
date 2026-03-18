<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use App\Events\ProductStockChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckStockLevel
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductStockChanged $event): void
    {
        $produtoAtual = $event->product;
        if($produtoAtual->stock_quantity <= $produtoAtual->alert_threshold){
            Log::info("O produto " .  $event->product->name . " está com estoque baixo!");
        }
    }
}
