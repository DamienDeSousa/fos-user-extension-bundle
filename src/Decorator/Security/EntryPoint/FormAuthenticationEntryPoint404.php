<?php

/**
 * Defines the FormAuthenticationEntryPoint404 class.
 *
 * @author Damien DE SOUSA
 * @copyright 2022
 */

declare(strict_types=1);

namespace Dades\FosUserExtensionBundle\Decorator\Security\EntryPoint;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\FormAuthenticationEntryPoint;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

/**
 * Decorates the FormAuthenticationEntryPoint in order to generate a 404 page
 * instead of redirecting to the admin login page.
 * This is done for security reason, avoid displaying admin login page.
 */
class FormAuthenticationEntryPoint404 implements AuthenticationEntryPointInterface
{
    private const ROOT_URI = '/admin';

    private FormAuthenticationEntryPoint $formAuthenticationEntryPoint;

    public function __construct(FormAuthenticationEntryPoint $formAuthenticationEntryPoint)
    {
        $this->formAuthenticationEntryPoint = $formAuthenticationEntryPoint;
    }

    public function start(Request $request, ?AuthenticationException $authException = null)
    {
        if (str_starts_with($request->getRequestUri(), self::ROOT_URI)) {
            throw new NotFoundHttpException();
        }

        $this->formAuthenticationEntryPoint->start($request, $authException);
    }
}
