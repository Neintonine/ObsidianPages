<?php
declare(strict_types=1);

namespace ObsidianPages\Routing\Routes;

use ObsidianPages\Authentication\AuthenticationHandler;
use ObsidianPages\Configuration\ConfigurationHandler;
use ObsidianPages\Configuration\Configurations\BasicConfiguration;
use ObsidianPages\Lib\Utils;
use ObsidianPages\Routing\Route;
use ObsidianPages\Routing\RouteData;
use ObsidianPages\Routing\RouteResult;
use ObsidianPages\Templates\Template;

final class LoginRoute implements Route
{

    public function AppliesTo(RouteData $requestData): bool
    {
        return $requestData->uri == '/login';
    }

    public function Act(RouteData $requestData): RouteResult
    {
        $configInstance = ConfigurationHandler::Instance();

        if (!AuthenticationHandler::hasAvailiableAuthentication()) {
            header("Location: ". $configInstance->Get(BasicConfiguration::class)->getBaseURL());
            exit();
        }

        $result = '';
        if (!empty($_POST)) {

            $authResult = AuthenticationHandler::authenticate($_POST);
            if ($authResult === true) {
                header("Location: ". $configInstance->Get(BasicConfiguration::class)->getBaseURL());
                exit();
            }

            $result = $authResult;
        }


        $template = (new Template());
        $template->assign('formular', AuthenticationHandler::getAuthentication()->getFormular());
        $template->assign('authResult', $result);
        return RouteResult::Content200($template->fetch('login.tpl'));
    }
}