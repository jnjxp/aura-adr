<?php

declare(strict_types=1);

namespace Jnjxp\AuraAdr;

use Aura\Router\Route as AuraRoute;
use Jnjxp\Adr\Input\Input;
use Jnjxp\Adr\Respond\ResponderAcceptsInterface;
use Jnjxp\Adr\Respond\Responder;

class Route extends AuraRoute
{
    protected $input = Input::class;
    protected $domain;
    protected $responder = Responder::class;

    public function name($name)
    {
        parent::name($name);

        $input = $this->name . '\\Input';
        if (class_exists($input)) {
            $this->input($input);
        }

        $responder = $this->name . '\\Responder';
        if (class_exists($responder)) {
            $this->responder($responder);
        }

        return $this;
    }

    public function handler($handler)
    {
        $this->domain($handler);
        return $this;
    }

    public function input($input)
    {
        $this->input = $input;
        return $this;
    }

    public function domain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    public function responder($responder)
    {
        $this->responder = $responder;
        $this->accepts = [];

        $accepts = is_subclass_of($responder, ResponderAcceptsInterface::class, true);

        if ($accepts) {
            $this->accepts($responder::accepts());
        }

        return $this;
    }
}
