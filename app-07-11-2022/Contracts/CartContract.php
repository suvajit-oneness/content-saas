<?php

namespace App\Contracts;

/**
 * Interface CartContract
 * @package App\Contracts
 */
interface CartContract
{
   
    public function addToCart(array $data);
    public function viewByIp();
    public function delete(int $id);
    
}
