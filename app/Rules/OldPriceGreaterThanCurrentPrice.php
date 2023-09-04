<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OldPriceGreaterThanCurrentPrice implements Rule
{
    public function passes($attribute, $value)
    {
        $currentPrice = request('price');
        $oldPrice = request('old_price');

        return $oldPrice > $currentPrice || empty($oldPrice);
    }

    public function message()
    {
        return __('Old price must be greater than the current price.');
    }
}
