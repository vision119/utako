<?php

namespace App\Entity\Taxonomy;

use App\Repository\Taxonomy\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
#[ORM\Table(name: 'taxonomy_country')]
class Country extends Taxonomy
{
    
}
