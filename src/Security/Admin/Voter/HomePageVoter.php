<?php

/**
 * File that defines the HomePageVoter class.
 *
 * @author    Damien DE SOUSA
 * @copyright 2021
 */

declare(strict_types=1);

namespace Dades\FosUserExtensionBundle\Security\Admin\Voter;

use App\Entity\User;
use Dades\FosUserExtensionBundle\Security\UserRoles;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * This class tells if a user can access the admin homepage.
 */
class HomePageVoter extends Voter
{
    public const HOMEPAGE = 'homepage';

    public function __construct(private Security $security)
    {
    }

    protected function supports($attribute, $subject): bool
    {
        return $attribute === self::HOMEPAGE && is_null($subject);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        if ($attribute === self::HOMEPAGE) {
            return $this->security->isGranted(UserRoles::ROLE_ADMIN);
        }

        throw new \LogicException('This code should not be reached!');
    }
}
