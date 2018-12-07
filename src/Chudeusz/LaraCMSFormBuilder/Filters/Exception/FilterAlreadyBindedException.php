<?php

namespace Chudeusz\LaraCMSFormBuilder\Filters\Exception;

/**
 * Class FilterAlreadyBinded
 *
 * @package Chudeusz\LaraCMSFormBuilder\Filters\Exception
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 */
class FilterAlreadyBindedException extends \Exception
{
    public function __construct($filter, $field)
    {
        $message = sprintf(
            'Filter with name: %filter already assigned for field: %field',
                $filter, $field
        );
        parent::__construct($message);
    }
}