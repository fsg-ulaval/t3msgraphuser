<?php

defined('TYPO3_MODE') || die();

(static function (string $extKey) {
    // Require 3rd-party libraries, in case TYPO3 does not run in composer mode
    $pharFileName = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($extKey)
                    . 'Libraries/thenetworg-oauth2-azure.phar';
    if (is_file($pharFileName)) {
        @include 'phar://' . $pharFileName . '/vendor/autoload.php';
    }
})('t3msgraphuser');
