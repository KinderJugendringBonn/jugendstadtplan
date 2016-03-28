<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TraegerRepository extends EntityRepository {
    
    public function findAllActivated() {
        return $this->findBy(array('isActive' => true));
    }

}
 