<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getCacheDir(): string
    {
        if ('prod' === $this->getEnvironment()) {
            return '/var/cache/dev.outadoc.fr/' . $this->environment;
        }

        return $this->getProjectDir() . '/var/cache/' . $this->environment;
    }

    public function getLogDir(): string
    {
        if ('prod' === $this->getEnvironment()) {
            return '/var/log/dev.outadoc.fr/' . $this->environment;
        }

        return $this->getProjectDir() . '/var/log';
    }
}
