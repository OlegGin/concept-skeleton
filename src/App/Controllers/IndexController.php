<?php declare(strict_types=1);

namespace Concept\App\Controllers;

use Concept\Core\Services\View\Contracts\ViewResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class IndexController
{
    public function __construct(
        private readonly ViewResponseFactoryInterface $viewResponse
    ) {}

    public function index(): ResponseInterface
    {
        return $this->viewResponse->create('@frontend/index');
    }
}