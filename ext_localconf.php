<?php

defined('TYPO3') or die();

(static function (): void {
    // Register the iCal export plugin
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'MaiCalendar',
        'ICalExport',
        [
            \Maispace\MaiCalendar\Controller\CalendarController::class => 'icalExport',
        ],
        [
            \Maispace\MaiCalendar\Controller\CalendarController::class => 'icalExport',
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );
})();
