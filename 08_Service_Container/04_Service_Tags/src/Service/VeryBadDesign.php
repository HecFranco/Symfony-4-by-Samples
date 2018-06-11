<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class VeryBadDesign implements ContainerAwareInterface
{
    public function setContainer(ContainerInterface $container = null)
    {
        // $container->get(Greeting::class);
        $container->get('app.greeting');
    }
}