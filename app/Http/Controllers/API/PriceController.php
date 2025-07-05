<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/prices",
     *     summary="Все Продукты",
     *     description="Вывод на конвертированной валюте (RUB, USD, EUR)",
     *     operationId="getPrices",
     *     tags={"Prices"},
     *
     *     @OA\Parameter(
     *         name="currency",
     *         in="query",
     *         description="Валюта отображения цен (по умолчанию RUB)",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             enum={"RUB", "USD", "EUR"}
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Ответ в случае удачи будет выглядеть так",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="iPhone 15"),
     *                 @OA\Property(property="price", type="string", example="$999.99")
     *             )
     *         )
     *     )
     * )
     */



    public function index(Request $request)
    {

        $selectedCurrency = isset($request->currency) ? $request->currency : 'RUB';

        $items = Product::all();

        foreach ($items as $item) {
            $item->currency = $selectedCurrency;
        }
        return ProductResource::collection($items);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
