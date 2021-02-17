<?php

declare(strict_types=1);

namespace Jnjxp\AuraAdr;

use Psr\Container\NotFoundExceptionInterface;

class ServiceNotFoundException extends \Exception implements NotFoundExceptionInterface
{
}
