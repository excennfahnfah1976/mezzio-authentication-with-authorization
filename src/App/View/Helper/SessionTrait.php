<?php

// src/App/View\Helper\SessionTrait.php

declare(strict_types=1);

namespace App\View\Helper;

use function headers_sent;
use function ob_start;
use function session_start;
use function session_status;

use const PHP_SESSION_NONE;

trait SessionTrait
{
    public function checkIsStarted(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            if (headers_sent()) {
                ob_start();
            }

            session_start();
        }
    }
}
