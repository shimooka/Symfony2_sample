<?php

namespace Acme\FormTypeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FormtypeRepositoryクラス
 *
 * @version $Id$
 */
class FormtypeRepository extends EntityRepository
{
    public function findBySearchForm(array $data) {
        $binds = array();
        $query = 'SELECT a FROM AcmeFormTypeBundle:Formtype a WHERE 1 = 1 ';
        foreach ($data as $name => $value) {
            if ($value !== null) {
                $query .= "AND a.{$name} LIKE :{$name} ";
                $binds[$name] = "%{$value}%";
            }
        }
        $query .= "ORDER BY a.id ASC ";

        return $this->getEntityManager()
            ->createQuery($query)
            ->setParameters($binds)
            ->getResult();
    }
}