<?php

namespace App\Contracts;

/**
 * Interface CheckoutContract
 * @package App\Contracts
 */
interface CheckoutContract
{
    
    public function viewCart();

    public function create(array $data);
}
