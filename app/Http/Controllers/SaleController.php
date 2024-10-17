<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use Exception;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/sell-car",
     *     tags={"Car Sales"},
     *     summary="Sell a car",
     *     description="Process the sale of a car and generate an invoice",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"car_id", "buyer_name", "buyer_dni", "price", "installments"},
     *             @OA\Property(property="car_id", type="string", example="f50b17d1-43c6-4db3-8f1b-7480b6306e69"),
     *             @OA\Property(property="buyer_name", type="string", example="Juan Pérez"),
     *             @OA\Property(property="buyer_dni", type="string", example="12345678"),
     *             @OA\Property(property="price", type="number", example=50000),
     *             @OA\Property(property="installments", type="integer", example=6)
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car sold successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="buyer", type="object",
     *                 @OA\Property(property="name", type="string", example="Juan Pérez"),
     *                 @OA\Property(property="dni", type="string", example="12345678")
     *             ),
     *             @OA\Property(property="car", type="object",
     *                 @OA\Property(property="name", type="string", example="Toyota Corolla")
     *             ),
     *             @OA\Property(property="total_price", type="number", example=50000.00),
     *             @OA\Property(property="price_per_installment", type="number", example=8333.33)
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="error", type="string", example="Validation error or processing issue")
     *         )
     *     )
     * )
     */
    public function sellCar(Request $request)
    {
        try {
            $data = $request->validate([
                'car_id' => 'required|exists:cars,id',
                'buyer_name' => 'required|string',
                'buyer_dni' => 'required|string',
                'price' => 'required|numeric',
                'installments' => 'required|integer|min:1|max:12',
            ]);

            $invoice = $this->carSale->processSale($data);

            return new InvoiceResource($invoice);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }
}
