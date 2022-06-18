<?php

/**
 * File that defines the Las user name class. This class retrieves the last username set in a form.
 *
 * @author    Damien DE SOUSA <desousadamien30@gmail.com>
 * @copyright 2021 Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\FosUserExtensionBundle\Security\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Security;

class LastUsername
{
    public function getLastUserName(Request $request): ?string
    {
        /** @var Session $session */
        $session = $request->getSession();
        $lastUsernameKey = Security::LAST_USERNAME;

        return (null === $session) ? '' : $session->get($lastUsernameKey);
    }
}
