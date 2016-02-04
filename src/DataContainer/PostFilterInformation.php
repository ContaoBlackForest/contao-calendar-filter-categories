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

use Contao\Model\Collection;
use ContaoBlackForest\Module\CalendarFilter\Event\PostFilterInformationEvent;
use MaeEventCategories\MaeEvent;
use MaeEventCategories\MaeEventCatModel;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;

class PostFilterInformation extends Event
{
    public function getInformation(PostFilterInformationEvent $event, $name, EventDispatcher $eventDispatcher)
    {
        if ($event->getFilter() != 'categories') {
            return;
        }


        $information     = array();
        /** @var Collection $categoriesModel */
        $categoriesModel = MaeEventCatModel::findAll();

        foreach ($event->getEvents() as $eventItem) {
            if (empty($eventItem['categories'])) {
                continue;
            }

            $chunks = deserialize($eventItem['categories']);
            foreach ($chunks as $chunk) {
                if (array_key_exists($chunk, $information)) {
                    continue;
                }

                if ($categoriesModel) {
                    while ($categoriesModel->next()) {
                        if ($categoriesModel->id != $chunk) {
                            continue;
                        }

                        $information[$chunk] = $categoriesModel->title;
                    }
                    $categoriesModel->reset();
                }
            }
        }

        $event->setInformation($information);
    }
}
