<?php

declare(strict_types=1);

namespace FSG\MsGraphUser\Domain\Model\Dto;

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

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ExtensionConfiguration
 */
class ExtensionConfiguration implements SingletonInterface
{
    /**
     * @var string
     */
    protected $clientId = '';

    /**
     * @var string
     */
    protected $clientSecret = '';

    /**
     * @var string
     */
    protected $tenant = '';

    /**
     * ExtensionConfiguration constructor.
     */
    public function __construct()
    {
        $settings = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)
                                  ->get('t3msgraphuser');

        foreach ($settings as $key => $value) {
            if (property_exists($this, $key)) {
                settype($value, gettype($this->$key));
                $this->$key = $value;
            }
        }
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @return string
     */
    public function getTenant(): string
    {
        return $this->tenant;
    }
}
