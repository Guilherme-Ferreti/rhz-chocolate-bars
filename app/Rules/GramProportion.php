<?php

namespace App\Rules;

use App\Models\CocoaBatch;
use Illuminate\Contracts\Validation\Rule;

class GramProportion implements Rule
{
    protected $max_grams;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $max_grams)
    {
        $this->max_grams = $max_grams;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $organic_grams = 0;
        $preprocessed_grams = 0;

        foreach ($value as $item) {
            $cocoa_batch = CocoaBatch::find($item['id']);

            if (! $cocoa_batch) {
                return false;
            }

            if ($cocoa_batch->origin === CocoaBatch::ORIGINS['organic']) {
                $organic_grams += (int) $item['grams'];
                continue;
            }
        
            if ($cocoa_batch->origin === CocoaBatch::ORIGINS['preprocessed']) {
                $preprocessed_grams += (int) $item['grams'];
            }
        }

        if ($organic_grams + $preprocessed_grams !== $this->max_grams) {
            return false;
        }

        $organic_percentage = ($organic_grams * 100) / $this->max_grams;
        $preprocessed_percentage = ($preprocessed_grams * 100) / $this->max_grams;

        if ($organic_percentage < 90 || $preprocessed_percentage > 10) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The chocolate bar must be composed of at least 90% organic cocoa and at maximum 10% preprocessed cocoa.';
    }
}
