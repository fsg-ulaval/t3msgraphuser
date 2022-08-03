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

use FSG\MsGraphUser\Traits\AuthenticationTrait;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

/**
 *
 */
class UserService
{
    use AuthenticationTrait;

    /**
     * @param string $identifier
     *
     * @return array
     * @throws IdentityProviderException
     */
    public function getUser(string $identifier): array
    {
        $provider    = $this->getProvider();
        $accessToken = $provider->getAccessToken('client_credentials',
                                                 ['scope' => $provider->getRootMicrosoftGraphUri(null) . '/.default']);
        return $provider->get($provider->getRootMicrosoftGraphUri(null) . '/v1.0/users/' . $identifier, $accessToken);
    }
}
