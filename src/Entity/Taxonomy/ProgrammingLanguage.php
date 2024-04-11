<?php

namespace App\Entity\Taxonomy;

use App\Repository\Taxonomy\ProgrammingLanguageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammingLanguageRepository::class)]
#[ORM\Table(name: 'taxonomy_programming_language')]
class ProgrammingLanguage extends Taxonomy
{
    
}
