<?php

/**
 * Define DemoteUserCommand class that decorate the FOSDemoteUserCommand class.
 * It test the availability of the given role.
 *
 * @author    Damien DE SOUSA <email@email.com>
 * @copyright 2020 Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\FosUserExtensionBundle\Decorator\Fos\UserBundle\Command;

use Dades\FosUserExtensionBundle\Security\UserRoles;
use FOS\UserBundle\Command\DemoteUserCommand as FOSDemoteUserCommand;
use FOS\UserBundle\Util\UserManipulator;
use Symfony\Component\Console\Output\OutputInterface;

class DemoteUserCommand extends FOSDemoteUserCommand
{
    public function __construct(
        UserManipulator $manipulator,
        private FOSDemoteUserCommand $fosDemotedUserCommand,
        private UserRoles $userRoles
    ) {
        parent::__construct($manipulator);
    }

    /**
     * {@inheritDoc}
     */
    protected function executeRoleCommand(
        UserManipulator $manipulator,
        OutputInterface $output,
        $username,
        $super,
        $role
    ) {
        $availableRoles = $this->userRoles->getDefinedRoles();
        if (!isset($availableRoles[$role])) {
            $output->writeln('The role ' . $role . ' is not available.');
            $output->writeln('Available roles are : ' . $this->formatRoles($availableRoles));

            return;
        }

        $this->fosDemotedUserCommand->executeRoleCommand($manipulator, $output, $username, $super, $role);
    }

    protected function formatRoles(array $roles): string
    {
        return implode(';', array_keys($roles));
    }
}
