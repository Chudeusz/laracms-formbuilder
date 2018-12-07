<?php

namespace Chudeusz\LaraCMSFormBuilder\Filters\Exception;

use Chudeusz\LaraCMSFormBuilder\Filters\FilterInterface;
use Throwable;

/**
 * Class InvalidInstanceException
 *
 * @package Chudeusz\LaraCMSFormBuilder\Filters\Exception
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 */
class InvalidInstanceException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = 'Filter object must implement ' . FilterInterface::class;
        parent::__construct($message, $code, $previous);
    }
}