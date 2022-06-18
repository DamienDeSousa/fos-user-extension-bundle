<?php

namespace Dades\FosUserExtensionBundle\Security;

interface UserRolesInterface
{
    public function getDefinedRoles(): array;
}
