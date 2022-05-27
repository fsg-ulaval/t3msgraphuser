<?php

declare(strict_types=1);

namespace FSG\MsGraphUser\Service;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use FSG\MsGraphUser\Domain\Model\Dto\ExtensionConfiguration;
use FSG\MsGraphUser\Error\ConfigurationException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use UnexpectedValueException;

/**
 * Class StatusService
 *
 * This class is used to validate that the minimum configurations are set.
 */
class StatusService
{
    /**
     * @return bool
     * @throws UnexpectedValueException | ConfigurationException
     */
    public static function isConfigured(): bool
    {
        /**
         * @var ExtensionConfiguration $extensionConfiguration
         */
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);

        if (!$extensionConfiguration->getClientId()) {
            throw new ConfigurationException('No client ID is set', 1613676692);
        }

        if (!$extensionConfiguration->getClientSecret()) {
            throw new ConfigurationException('No client secret is set', 1613676693);
        }

        if (!$extensionConfiguration->getTenant()) {
            throw new ConfigurationException('No tenant is set', 1613676696);
        }

        return true;
    }
}
