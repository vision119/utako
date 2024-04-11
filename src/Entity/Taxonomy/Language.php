<?php

namespace App\Entity\Taxonomy;

use App\Repository\Taxonomy\LanguageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
#[ORM\Table(name: 'taxonomy_language')]
class Language extends Taxonomy
{
    
}
