<?php

/**
 * contao-calendar-filter-categories
 *
 * Copyright © ContaoBlackForest
 *
 * @package   contao-calendar-filter-categories
 * @file      config.php
 * @author    Sven Baumann <baumann.sv@gmail.com>
 * @author    Dominik Tomasi <dominik.tomasi@gmail.com>
 * @license   LGPL-3.0+
 * @copyright Copyright 2016 ContaoBlackForest
 */

$GLOBALS['TL_EVENTS'][\ContaoBlackForest\Module\CalendarFilter\Event\GetFilterOptionsEvent::NAME][] =
    array(
        new \ContaoBlackForest\Module\CalendarFilter\Categories\DataContainer\GetFilterOptions(),
        'addFilterOptions'
    );

$GLOBALS['TL_EVENTS'][\ContaoBlackForest\Module\CalendarFilter\Event\PostFilterInformationEvent::NAME][] =
    array(
        new \ContaoBlackForest\Module\CalendarFilter\Categories\DataContainer\PostFilterInformation(),
        'getInformation'
    );

$GLOBALS['TL_EVENTS'][\ContaoBlackForest\Module\CalendarFilter\Event\PostFilterEventsEvent::NAME][] =
    array(
        new \ContaoBlackForest\Module\CalendarFilter\Categories\DataContainer\PostFilterEvents(),
        'getFilteredEvents'
    );
