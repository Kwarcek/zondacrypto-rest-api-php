<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Public\Enums;

enum Resolution: int
{
    case ONE_MINUTE = 60;
    case THREE_MINUTE = 180;
    case FIVE_MINUTE = 300;
    case FIFTEEN_MINUTE = 900;
    case THIRTY_MINUTE = 1800;
    case ONE_HOUR = 3600;
    case TWO_HOUR = 7200;
    case FOUR_HOUR = 14400;
    case SIX_HOUR = 21600;
    case TWELVE_HOUR = 43200;
    case ONE_DAY = 86400;
    case THREE_DAY = 259200;
    case ONE_WEEK = 604800;
}