<?php

namespace GGY\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GGYUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
