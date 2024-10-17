<?php

namespace App\Http\Utils;

use App\Models\Car;
use App\Models\Invoice;
use Exception;

class CarSale
{
    public function processSale($data)
    {
        return DB::transaction(function () use ($data) {
            if (!isset($data['car_id'], $data['buyer_name'], $data['buyer_dni'], $data['price'], $data['installments'])) {
                throw new Exception("Incomplete data");
            }
            $car = Car::find($data['car_id']);
            if (!$car || !$car->isAvailable()) {
                throw new Exception("Car not found");
            }

            $updated = $car->where('available', true)
                ->where('id', $data['car_id'])
                ->update(['available' => false]);

             if ($updated === 0) {
                throw new Exception("The car was sold before the transaction was completed.");
            }

            $price = $data['price'];
            $installments = $data['installments'];
            $surcharge = ($installments > 1) ? $price * 0.02 * ($installments - 1) : 0;

            $totalPrice = $price + $surcharge;
            $pricePerInstallment = $totalPrice / $installments;

            $invoice = Invoice::create([
                'buyer_name' => $data['buyer_name'],
                'buyer_dni' => $data['buyer_dni'],
                'car_id' => $car->id,
                'total_price' => $totalPrice,
                'price_per_installment' => $pricePerInstallment,
            ]);
            return $invoice;
        });
    }
}
