<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SafeHtml implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Simple HTML validation - you can expand this
        $dangerousTags = ['script', 'iframe', 'object', 'embed'];
        
        foreach ($dangerousTags as $tag) {
            if (stripos($value, "<{$tag}") !== false || 
                stripos($value, "</{$tag}") !== false) {
                $fail("The {$attribute} contains unsafe HTML tags.");
            }
        }
    }
}