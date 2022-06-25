<?php

namespace App\Controller;

use App\Service\CommandResponseService;

class ConsoleController
{
    private CommandResponseService $commandResponseService;

    public function __construct(CommandResponseService $commandResponseService)
    {
        $this->commandResponseService = $commandResponseService;
    }

    public function index(): void
    {
        echo 'Enter the command: ';
        $this->commandResponseService->getResponse(fgets(STDIN));
    }
}
