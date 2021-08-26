<?php

namespace App\Bardiz12\Fortify;

use Illuminate\Http\Request;


class FortifyCustomization{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;    
    }
    
}