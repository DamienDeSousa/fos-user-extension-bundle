<?php

/**
 * Defines UserRolesInterface interface.
 *
 * @author Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\FosUserExtensionBundle\Security;

/**
 * Provides method to get all defined roles in the application.
 */
interface UserRolesInterface
{
    /**
     * Return the list of roles defined in the application.
     *
     * @return array
     */
    public function getDefinedRoles(): array;
}
