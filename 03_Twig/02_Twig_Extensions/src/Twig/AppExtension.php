<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/* 
 * This extension of twig will only work with the following configuration in config/services.yaml.
 *  autoconfigure: true
 * If the autowiring in services.tml was not activated, the service would have to be declared.
 */ 
class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('price', [$this, 'priceFilter'])
        ];
    }
    public function priceFilter($number)
    {
        return '$'.number_format($number, 2, '.', ',');
    }
}