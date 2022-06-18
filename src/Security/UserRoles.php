<?php

/**
 * Define the role user class.
 *
 * @author    Damien DE SOUSA <email@email.com>
 * @copyright 2020 Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\FosUserExtensionBundle\Security;

use FOS\UserBundle\Model\UserInterface;

class UserRoles implements UserRolesInterface
{
    /**
     * Name of the admin role.
     */
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * Name of the super admin role.
     */
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    /**
     * @var array
     */
    protected array $roles;

    public function __construct(array $roles = [])
    {
        $this->roles = $roles;
        $this->roles[UserInterface::ROLE_DEFAULT] = [];
    }

    public function getDefinedRoles(): array
    {
        return $this->roles;
    }
}
