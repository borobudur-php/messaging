<?php
/**
 * This file is part of the Borobudur package.
 *
 * (c) 2017 Borobudur <http://borobudur.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Borobudur\Component\Messaging\Metadata;

use Borobudur\Component\Parameter\ParameterInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface MetadataInterface
{
    /**
     * Gets the message alias.
     *
     * @return string
     */
    public function getAlias(): string;

    /**
     * Gets the message name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Gets the application or package name.
     *
     * @return string
     */
    public function getApplicationName(): string;

    /**
     * Gets the message class.
     *
     * @return string
     */
    public function getMessageClass(): string;

    /**
     * Gets the message handler class.
     *
     * @return string
     */
    public function getHandlerClass(): string;

    /**
     * Gets the message factory class.
     *
     * @return string
     */
    public function getFactoryClass(): string;

    /**
     * Gets the service id.
     *
     * @param string $serviceName
     *
     * @return string
     */
    public function getServiceId(string $serviceName): string;

    /**
     * Get extra parameters.
     *
     * @return ParameterInterface
     */
    public function getParameter(): ParameterInterface;
}
