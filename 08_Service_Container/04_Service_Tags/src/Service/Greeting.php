<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class Greeting
{
  private $logger;

  public function __construct(LoggerInterface $logger)
  {
    $this->logger = $logger;
  }    
  public function greet(string $name): string
  {
    $this->logger->info("greeted $name");
    return "Hello $name";
  }
}