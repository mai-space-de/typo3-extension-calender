<?php

declare(strict_types=1);

use Maispace\MaiBase\TableConfigurationArray\Helper;
use Maispace\MaiBase\TableConfigurationArray\Table;

$lang = Helper::localLangHelperFactory('mai_events', 'Default/locallang_tca.xlf');

return (new Table($lang('table.tx_maievents_registration')))
    ->setDefaultConfig()
    ->setLabel('last_name')
    ->setAlternativeLabelFields('first_name, email')
    ->appendAlternativeLabelToLabel()
    ->setSearchFields('first_name, last_name, email')
    ->setIconFile('EXT:mai_events/Resources/Public/Icons/tx_maievents_registration.svg')
    ->setDefaultSorting('ORDER BY registered_at DESC')
    ->addColumn(
        'event',
        $lang('tx_maievents_registration.event'),
        [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'foreign_table' => 'tx_maievents_event',
            'foreign_table_where' => 'ORDER BY tx_maievents_event.start_date DESC',
            'minitems' => 1,
            'maxitems' => 1,
        ]
    )
    ->addColumn(
        'first_name',
        $lang('tx_maievents_registration.first_name'),
        ['type' => 'input', 'size' => 30, 'max' => 100, 'eval' => 'trim,required']
    )
    ->addColumn(
        'last_name',
        $lang('tx_maievents_registration.last_name'),
        ['type' => 'input', 'size' => 30, 'max' => 100, 'eval' => 'trim,required']
    )
    ->addColumn(
        'email',
        $lang('tx_maievents_registration.email'),
        ['type' => 'email', 'eval' => 'required']
    )
    ->addColumn(
        'status',
        $lang('tx_maievents_registration.status'),
        [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['label' => $lang('tx_maievents_registration.status.registered'), 'value' => 'registered'],
                ['label' => $lang('tx_maievents_registration.status.waiting'), 'value' => 'waiting'],
                ['label' => $lang('tx_maievents_registration.status.cancelled'), 'value' => 'cancelled'],
            ],
            'default' => 'registered',
        ]
    )
    ->addColumn(
        'registered_at',
        $lang('tx_maievents_registration.registered_at'),
        ['type' => 'datetime', 'format' => 'datetime', 'readOnly' => true]
    )
    ->addColumn(
        'confirmed_at',
        $lang('tx_maievents_registration.confirmed_at'),
        ['type' => 'datetime', 'format' => 'datetime', 'readOnly' => true]
    )
    ->addPalette(
        'name',
        $lang('palette.name'),
        'first_name, last_name'
    )
    ->addPalette(
        'dates',
        $lang('palette.dates'),
        'registered_at, confirmed_at'
    )
    ->addTypeShowItem(
        '0',
        'event, --palette--;;name, email, status, --palette--;;dates'
    )
    ->getConfig();
