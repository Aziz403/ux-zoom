<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Aziz403 <azizbenmallouk4@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Aziz403\UX\Zoom;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Aziz403 <azizbenmallouk4@gmail.com>
 *
 * @final
 */
class UxZoomBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
