<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\CloudPatches\Shell\Command;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Throwable;

/**
 * Unix patch driver exception
 */
class PatchDriverException extends DriverException
{
    /**
     * @param Throwable $previous
     */
    public function __construct(Throwable $previous)
    {
        $message = $previous->getMessage();
        if ($previous instanceof ProcessFailedException) {
            $message = $previous->getProcess()->getErrorOutput() ?: ($previous->getProcess()->getOutput() ?: $message);
        }
        parent::__construct($message, $previous->getCode(), $previous);
    }
}
