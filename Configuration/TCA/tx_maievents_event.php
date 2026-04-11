<?php

declare(strict_types=1);

use Maispace\MaiBase\TableConfigurationArray\Helper;
use Maispace\MaiBase\TableConfigurationArray\Table;

$lang = Helper::localLangHelperFactory('mai_events', 'Default/locallang_tca.xlf');

return (new Table($lang('table.tx_maievents_event')))
    ->setDefaultConfig()
    ->setLabel('title')
    ->setAlternativeLabelFields('start_date')
    ->setSearchFields('title, description, location')
    ->setIconFile('EXT:mai_events/Resources/Public/Icons/tx_maievents_event.svg')
    ->setDefaultSorting('ORDER BY start_date ASC')
    ->setThumbnailField('image')
    ->addColumn(
        'title',
        $lang('tx_maievents_event.title'),
        ['type' => 'input', 'size' => 50, 'max' => 255, 'eval' => 'trim,required']
    )
    ->addColumn(
        'description',
        $lang('tx_maievents_event.description'),
        [
            'type' => 'text',
            'rows' => 10,
            'cols' => 50,
            'enableRichtext' => true,
            'richtextConfiguration' => 'default',
        ]
    )
    ->addColumn(
        'location',
        $lang('tx_maievents_event.location'),
        ['type' => 'input', 'size' => 50, 'max' => 255, 'eval' => 'trim']
    )
    ->addColumn(
        'start_date',
        $lang('tx_maievents_event.start_date'),
        ['type' => 'datetime', 'format' => 'datetime', 'eval' => 'required']
    )
    ->addColumn(
        'end_date',
        $lang('tx_maievents_event.end_date'),
        ['type' => 'datetime', 'format' => 'datetime']
    )
    ->addColumn(
        'registration_deadline',
        $lang('tx_maievents_event.registration_deadline'),
        ['type' => 'datetime', 'format' => 'datetime']
    )
    ->addColumn(
        'max_attendees',
        $lang('tx_maievents_event.max_attendees'),
        ['type' => 'number', 'format' => 'integer', 'default' => 0]
    )
    ->addColumn(
        'has_waiting_list',
        $lang('tx_maievents_event.has_waiting_list'),
        [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'default' => 0,
        ]
    )
    ->addColumn(
        'image',
        $lang('tx_maievents_event.image'),
        [
            'type' => 'file',
            'allowed' => 'common-image-types',
            'maxitems' => 1,
            'appearance' => [
                'createNewRelationLinkTitle' => $lang('tx_maievents_event.image.addFile'),
            ],
        ]
    )
    ->addColumn(
        'categories',
        $lang('tx_maievents_event.categories'),
        ['type' => 'category']
    )
    ->addPalette(
        'dates',
        $lang('palette.dates'),
        'start_date, end_date, registration_deadline'
    )
    ->addPalette(
        'registration',
        $lang('palette.registration'),
        'max_attendees, has_waiting_list'
    )
    ->addTypeShowItem(
        '0',
        'title, description, location, image, categories,
        --div--;' . $lang('tab.dates') . ', --palette--;;dates,
        --div--;' . $lang('tab.registration') . ', --palette--;;registration,
        --div--;' . $lang('tab.language') . ', --palette--;;language,
        --div--;' . $lang('tab.access') . ', --palette--;;hidden, --palette--;;access'
    )
    ->getConfig();
