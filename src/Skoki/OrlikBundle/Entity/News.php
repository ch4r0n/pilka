<?php

namespace Skoki\OrlikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\NewsBundle\Model\News as BaseNews;

/**
 * @ORM\Entity
 * @ORM\Table(name="fsi_news")
 */
class News extends BaseNews
{
    public function __construct()
    {
        $this->date = new \DateTime();
    }
}