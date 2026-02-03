<?php

namespace App\Exceptions;

use Exception;

class InsufficientStockException extends Exception
{
    public function __construct(string $productName, int $available, int $required)
    {
        $message = "Insufficient stock for product: {$productName}. Available: {$available}, Required: {$required}";
        parent::__construct($message);
    }
}
