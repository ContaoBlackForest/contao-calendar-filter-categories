<?php

/**
 * contao-calendar-filter-categories
 *
 * Copyright © ContaoBlackForest
 *
 * @package   contao-calendar-filter-categories
 * @file      tl_module.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   LGPL-3.0+
 * @copyright Copyright 2016 ContaoBlackForest
 */

namespace ContaoBlackForest\Module\CalendarFilter\Categories\DataContainer;

use ContaoBlackForest\Module\CalendarFilter\Event\GetFilterOptionsEvent;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;

class GetFilterOptions extends Event
{
    public function addFilterOptions(GetFilterOptionsEvent $event, $name, EventDispatcher $eventDispatcher)
    {
        if ($event->hasOption('categories')) {
            return;
        }

        $event->setOption('categories', $GLOBALS['TL_LANG']['tl_module']['filterCategories']);
    }
}
