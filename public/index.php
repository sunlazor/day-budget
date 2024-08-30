<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

\Symfony\Component\HttpFoundation\Request::setFactory(function (...$args) {
    return new \Seaworn\HtmxBundle\Request\HtmxRequest(...$args);
});

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
