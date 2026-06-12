<?php declare(strict_types=1);

namespace Concept\App\Extensions\Twig;

use Concept\Core\Http\Routing\Contracts\UrlGeneratorInterface;
use Concept\Core\Services\View\ViewContextResolver;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;

/**
 * Main extension class for application-specific Twig logic.
 * Located in Extensions/Twig to allow future expansion of other system parts.
 */
class AppExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(
        private readonly ViewContextResolver $routeNamespaceResolver,
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {}

    public function getGlobals(): array
    {
        return [
            'route_namespace' => $this->routeNamespaceResolver->resolve(),
        ];
    }

    /**
     * Register custom filters here.
     * new TwigFilter('example', [$this, 'exampleFilter']),
     * Usage in Twig: {{ var | my_filter }}
     */
    public function getFilters(): array
    {
        return [];
    }

    /**
     * Register custom functions here.
     * new TwigFunction('example', fn() => $this->example),
     * Usage in Twig: {{ my_function() }}
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('uri', [$this->urlGenerator, 'uri']),
            new TwigFunction('url', [$this->urlGenerator, 'url']),
            new TwigFunction('base_url', [$this->urlGenerator, 'base']),
        ];
    }
}