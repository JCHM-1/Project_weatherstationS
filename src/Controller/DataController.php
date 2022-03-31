<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DataController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}
    
    

}