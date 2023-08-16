<?php

namespace App\Utils;


use Illuminate\Support\Facades\DB;

class ProduitUtil extends Util
{



 /**
     * Generates product sku
     *
     * @param string $string
     *
     * @return generated sku (string)
     */
    public function generateProductSku($string)
    {


        return str_pad($string, 4, '0', STR_PAD_LEFT);
    }

}
