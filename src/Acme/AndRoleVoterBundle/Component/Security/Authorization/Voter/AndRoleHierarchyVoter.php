<?php

namespace Acme\AndRoleVoterBundle\Component\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\RoleHierarchyVoter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * AndRoleHierarchyVoter votes if any attribute starts with a given prefix.
 *
 * @author SHIMOOKA Hideyuki <shimooka@doyouphp.jp>
 */
class AndRoleHierarchyVoter extends RoleHierarchyVoter
{
    /**
     * {@inheritdoc}
     */
    public function vote(TokenInterface $token, $object, array $attributes)
    {
        $satisfied_roles = true;
        $roles = $this->extractRoles($token);
        foreach ($attributes as $attribute) {
            if (!$this->supportsAttribute($attribute)) {
                continue;
            }
            $has_role = false;
            foreach ($roles as $role) {
                if ($attribute === $role->getRole()) {
                    $has_role = true;
                }
            }
            $satisfied_roles &= $has_role;
        }
        return ($satisfied_roles ? VoterInterface::ACCESS_GRANTED : VoterInterface::ACCESS_DENIED);
    }
}
