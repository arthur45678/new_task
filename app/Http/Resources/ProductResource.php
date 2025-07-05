<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $selectedCurrency = $this->currency ?? 'RUB';

        $conversionRates = [
            'RUB' => 1,
            'USD' => 1  / 90,
            'EUR' => 1/ 100,
        ];

        $currencySymbols = [
            'RUB' => 'Rubly',
            'USD' => 'Dollar',
            'EUR' => 'Euro',
        ];

        $cource = $conversionRates[$selectedCurrency] ?? 1;
        $symbol = $currencySymbols[$selectedCurrency] ?? '';

        $finalPrice = $this->price * $cource;

        if ($selectedCurrency == 'RUB') {
            $formatted = number_format($finalPrice, 0, ',', ' ') . ' ' . $symbol;
        } else {
            $formatted = $symbol . number_format($finalPrice, 2, '.', '');
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $formatted,

        ];
    }

}
