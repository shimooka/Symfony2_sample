<?php

namespace Acme\CompositePrimaryKeysBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CompositeKeysRepositoryクラス
 *
 * @version $Id$
 */
class CompositeKeysRepository extends EntityRepository
{
    public function findBySearchForm(array $data, $get_entity = true) {
        $binds = array();
        $select_clause = 'a';
        $order_clause = "ORDER BY a.key1 ASC, a.key2 ASC ";
        if (!$get_entity) {
            $select_clause = 'COUNT(a)';
            $order_clause = null;
        }
        $query = "SELECT {$select_clause} FROM AcmeCompositePrimaryKeysBundle:CompositeKeys a "
               . "WHERE 1 = 1 ";
        foreach ($data as $name => $value) {
            if ($value !== null) {
                $query .= "AND a.{$name} LIKE :{$name} ";
                $binds[$name] = "%{$value}%";
            }
        }
        $query .= $order_clause;

        $result = $this->getEntityManager()
            ->createQuery($query)
            ->setParameters($binds);

        if ($get_entity) {
            $result->setHint('knp_paginator.count', $this->findBySearchForm($data, false));
        } else {
            $result = $result->getSingleScalarResult();
        }
        return $result;
    }
}