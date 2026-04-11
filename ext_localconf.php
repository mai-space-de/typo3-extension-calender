<?php

defined('TYPO3') or die();

(static function (): void {
    // Register the iCal export plugin
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'MaiEvents',
        'ICalExport',
        [
            \Maispace\MaiEvents\Controller\EventsController::class => 'icalExport',
        ],
        [
            \Maispace\MaiEvents\Controller\EventsController::class => 'icalExport',
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );
})();
