<?php

/**
 * Define the login admin controller.
 *
 * @author    Damien DE SOUSA <email@email.com>
 * @copyright 2020 Damien DE SOUSA
 */

declare(strict_types=1);

namespace Dades\FosUserExtensionBundle\Controller\Admin\Security;

use Dades\FosUserExtensionBundle\Security\Admin\LastUsername;
use Dades\GregwarCaptchaExtensionBundle\Security\Admin\Login\Captcha;
use Dades\FosUserExtensionBundle\Security\Admin\AuthError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gregwar\CaptchaBundle\Generator\CaptchaGenerator;

class Login extends AbstractController
{
    public const LOGIN_PAGE_ROUTE = 'admin_login';

    public const LOGIN_PAGE_URI = '/admin-GC2NeDwu26y6pred';

    public function __construct(
        private CaptchaGenerator $captchaGenerator,
        private CsrfTokenManagerInterface $tokenManager,
        private AuthError $authError,
        private LastUsername $lastUsername,
        private Captcha $captcha,
        private array $gregwarCaptchaOptions
    ) {
    }

    public function __invoke(Request $request): Response
    {
        //Add LoginUserType
        $error = $this->authError->getError($request);
        $lastUsername = $this->lastUsername->getLastUserName($request);
        $csrfToken = $this->tokenManager?->getToken('authenticate')?->getValue();
        $viewParameters = [
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ];

        $activateCaptcha = $this->captcha->activate($request);
        $viewParameters['enable_captcha'] = $activateCaptcha;
        if ($activateCaptcha) {
            $code = $this->captchaGenerator->getCaptchaCode($this->gregwarCaptchaOptions);
            $viewParameters['code'] = $code;
            $viewParameters['width'] = $this->gregwarCaptchaOptions['width'];
            $viewParameters['height'] = $this->gregwarCaptchaOptions['height'];
        }

        return $this->render('admin/security/login.html.twig', $viewParameters);
    }
}
