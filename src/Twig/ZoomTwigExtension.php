<?php

namespace Aziz403\UX\Zoom\Twig;

use Aziz403\UX\Zoom\Model\ZoomMtg;
use Symfony\WebpackEncoreBundle\Twig\StimulusTwigExtension;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ZoomTwigExtension extends AbstractExtension
{
    private $stimulus;

    public function __construct(StimulusTwigExtension $stimulus)
    {
        $this->stimulus = $stimulus;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('render_zoom','renderZoom',['needs_environment' => true, 'is_safe' => ['html']])
        ];
    }

    public function renderZoom(Environment $env, ZoomMtg $zoom)
    {
        $controller = $this->stimulus->renderStimulusController(
            $env,
            $zoom->getController(),
            $zoom->createView()
        );
        return "<div ".$controller." ></div>";
    }
}