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

use ContaoBlackForest\Module\CalendarFilter\Event\PostFilterEventsEvent;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;

class PostFilterEvents extends Event
{
    public function getFilteredEvents(PostFilterEventsEvent $event, $name, EventDispatcher $eventDispatcher)
    {
        if ($event->getField() != 'categories') {
            return;
        }

        $events = $event->getEvents();
        $this->filterEvents($events, $event->getFilter());
        $event->setEvents($events);
    }

    protected function filterEvents(&$events, $filter)
    {
        foreach ($events as $index => $value) {
            $chunks = deserialize($value['categories']);
            if ($chunks === null) {
                $this->filterEvents($value, $filter);
            }
            if ($chunks === null) {
                echo "";
            }

            if (empty($value)
                || (array_key_exists('categories', $value)
                    && !in_array($filter, $chunks))
            ) {
                unset($events[$index]);
            }
        }
    }
}
