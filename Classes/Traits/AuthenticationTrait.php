<?php

declare(strict_types=1);

namespace FSG\MsGraphUser\Traits;

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
use FSG\MsGraphUser\Service\StatusService;
use TheNetworg\OAuth2\Client\Provider\Azure;
use TYPO3\CMS\Core\Utility\GeneralUtility;

trait AuthenticationTrait
{

    /**
     * @var ExtensionConfiguration
     */
    protected $extensionConfiguration;

    /**
     * @var Azure
     */
    protected $provider;

    /**
     * AuthenticationService constructor.
     *
     * @throws ConfigurationException
     */
    public function __construct()
    {
        StatusService::isConfigured();
        $this->extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
    }

    /**
     * @return Azure
     */
    protected function getProvider(): Azure
    {
        if (!isset($this->provider)) {
            $this->provider         = new Azure(
                [
                    'clientId'               => $this->extensionConfiguration->getClientId(),
                    'clientSecret'           => $this->extensionConfiguration->getClientSecret(),
                    'defaultEndPointVersion' => Azure::ENDPOINT_VERSION_2_0,
                ]
            );
            $this->provider->tenant = $this->extensionConfiguration->getTenant();
        }

        return $this->provider;
    }
}
