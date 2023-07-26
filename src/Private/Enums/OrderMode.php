<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Private\Enums;

enum OrderMode: string
{
    case LIMIT = 'limit';
    case MARKET = 'market';
}