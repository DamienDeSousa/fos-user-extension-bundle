<?php

/**
 * Defines DadesFosUserExtensionBundle class.
 *
 * @author Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\FosUserExtensionBundle;

use Dades\FosUserExtensionBundle\DependencyInjection\DadesFosUserExtensionExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Defines the bundle.
 */
class DadesFosUserExtensionBundle extends Bundle
{
    public function getContainerExtension(): ExtensionInterface|null
    {
        if (null === $this->extension) {
            $this->extension = new DadesFosUserExtensionExtension();
        }

        return $this->extension;
    }
}
