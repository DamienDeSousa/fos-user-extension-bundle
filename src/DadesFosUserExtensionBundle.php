<?php

namespace Dades\FosUserExtensionBundle;

use Dades\FosUserExtensionBundle\DependencyInjection\DadesFosUserExtensionExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

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
