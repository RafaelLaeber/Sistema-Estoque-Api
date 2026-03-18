<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryMovement;
use App\Events\ProductStockChanged;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\StoreUpdateRequest;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $produtos = Product::with('movements')->get();
        return response()->json($produtos);
    }

    public function registerSale(StoreSaleRequest $request)
    {
        $product = Product::findOrFail($request->product_id); //o findOrFail procura o produto. Se não achar, devolve um erro 404

        InventoryMovement::create([
            'product_id'=>$product->id,
            'quantity'=>-$request->quantity,
            'type'=> 'venda',
            'description' => 'Baixa de estoque via sistema'
        ]);

        $product->stock_quantity -= $request->quantity;
        $product->save();

        event(new ProductStockChanged($product));

        $resposta = [
            'message'=>'Venda registrada com sucesso!',
            'estoque_atual'=> $product->stock_quantity
        ];

        if($product->stock_quantity <= $product->alert_threshold){
            $resposta['alerta'] = 'Atenção: O produto ' . $product->name . ' está com estoque baixo!';
        }

        return response()->json($resposta, 201);
    }


public function registerPurchase(StoreSaleRequest $request)
    {
        $product = Product::findOrFail($request->product_id); //o findOrFail procura o produto. Se não achar, devolve um erro 404

        InventoryMovement::create([
            'product_id'=>$product->id,
            'quantity'=>$request->quantity,
            'type'=> 'compra',
            'description' => 'Entrada de estoque via sistema'
        ]);

        $product->stock_quantity += $request->quantity;
        $product->save();

        event(new ProductStockChanged($product));

        return response()->json([
            'message'=>'Estoque registrado com sucesso!',
            'estoque_atual'=> $product->stock_quantity
        ]);
    }

    public function show($id)
    {
        $product = Product::with('movements')->findOrFail($id);
        return response()->json($product);
    }

    public function update(StoreUpdateRequest $request, string $id)
    {

        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'produto' => $product
        ], 200);
    }

    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Não é possível excluir este produto pois ele possui movimentações no estoque.'
            ], 400);
        }
    }
}
