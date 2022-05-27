<?php

namespace App\Twig;

use Twig\TwigFunction;
use App\Entity\AccueilEcrit;
use Twig\Extension\AbstractExtension;
use Doctrine\ORM\EntityManagerInterface;

class InfoExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('textes', [$this,'getText'])
        ];
    }

    public function getText()
    {
        return $this->em->getRepository(AccueilEcrit::class)->findAll();
    }
}