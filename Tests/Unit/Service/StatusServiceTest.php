<?php

namespace FSG\MsGraphUser\Tests\Unit\Service;

use FSG\MsGraphUser\Domain\Model\Dto\ExtensionConfiguration;
use FSG\MsGraphUser\Error\ConfigurationException;
use FSG\MsGraphUser\Service\StatusService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Class StatusServiceTest
 */
class StatusServiceTest extends UnitTestCase
{
    /**
     * Sets up this test case.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->resetSingletonInstances = true;
    }

    /**
     * Test if the right exception code is return for no client ID configured
     *
     * @test
     */
    public function expectExceptionForNoClientIDConfigured(): void
    {
        $settings = [
            'clientId' => '',
        ];

        $extensionConfigurationMock = $this->getAccessibleMock(ExtensionConfiguration::class, ['dummy'], [], '', false);
        foreach ($settings as $key => $value) {
            $extensionConfigurationMock->_set($key, $value);
        }

        /**
         * @var ExtensionConfiguration $extensionConfigurationMock
         */
        GeneralUtility::setSingletonInstance(ExtensionConfiguration::class, $extensionConfigurationMock);

        $this->expectException(ConfigurationException::class);
        $this->expectExceptionCode(1613676692);
        StatusService::isConfigured();
    }

    /**
     * Test if the right exception code is return for no client secret configured
     *
     * @test
     */
    public function expectExceptionForNoClientSecretConfigured(): void
    {
        $settings = [
            'clientId'     => 'foo',
            'clientSecret' => '',
        ];

        $extensionConfigurationMock = $this->getAccessibleMock(ExtensionConfiguration::class, ['dummy'], [], '', false);
        foreach ($settings as $key => $value) {
            $extensionConfigurationMock->_set($key, $value);
        }

        /**
         * @var ExtensionConfiguration $extensionConfigurationMock
         */
        GeneralUtility::setSingletonInstance(ExtensionConfiguration::class, $extensionConfigurationMock);

        $this->expectException(ConfigurationException::class);
        $this->expectExceptionCode(1613676693);
        StatusService::isConfigured();
    }

    /**
     * Test if the right exception code is return for no tenant configured
     *
     * @test
     */
    public function expectExceptionForNoTenantConfigured(): void
    {
        $settings = [
            'clientId'     => 'foo',
            'clientSecret' => 'bar',
            'tenant'       => '',
        ];

        $extensionConfigurationMock = $this->getAccessibleMock(
            ExtensionConfiguration::class,
            ['dummy'],
            [],
            'ExtensionConfigurationMock',
            false
        );
        foreach ($settings as $key => $value) {
            $extensionConfigurationMock->_set($key, $value);
        }

        /**
         * @var ExtensionConfiguration $extensionConfigurationMock
         */
        GeneralUtility::setSingletonInstance(ExtensionConfiguration::class, $extensionConfigurationMock);

        $this->expectException(ConfigurationException::class);
        $this->expectExceptionCode(1613676696);
        StatusService::isConfigured();
    }

    /**
     * Test if the frontend authentication is disabled by default
     *
     * @test
     */
    public function expectTrueForIsConfigured(): void
    {
        $settings = [
            'clientId'     => 'foo',
            'clientSecret' => 'bar',
            'tenant'       => 'foo',
        ];

        $extensionConfigurationMock = $this->getAccessibleMock(ExtensionConfiguration::class, ['dummy'], [], '', false);
        foreach ($settings as $key => $value) {
            $extensionConfigurationMock->_set($key, $value);
        }

        /**
         * @var ExtensionConfiguration $extensionConfigurationMock
         */
        GeneralUtility::setSingletonInstance(ExtensionConfiguration::class, $extensionConfigurationMock);

        self::assertTrue(StatusService::isConfigured());
    }
}
