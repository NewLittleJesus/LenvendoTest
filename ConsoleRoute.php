<?php

namespace Route;

use App\Controller\ConsoleController;
use App\Service\CommandResponseService;
use CommandLibrary\Service\CommandService;

class ConsoleRoute
{
    public static function init(): void
    {
        $commandService = new CommandService();
        $commandResponseService = new CommandResponseService($commandService);
        $controller = new ConsoleController($commandResponseService);
        $controller->index();
    }
}
