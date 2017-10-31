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

namespace Borobudur\Component\Messaging\Request;

use Borobudur\Component\Http\RequestInterface;
use Borobudur\Component\Messaging\Metadata\MetadataInterface;
use Borobudur\Component\Parameter\ParameterInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface ConfigurationInterface
{
    /**
     * Gets the message metadata.
     *
     * @return MetadataInterface
     */
    public function getMetadata(): MetadataInterface;

    /**
     * Gets the request.
     *
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface;

    /**
     * Check whether request is html.
     *
     * @return bool
     */
    public function isHtmlRequest(): bool;

    /**
     * Gets the serialization groups.
     *
     * @return array
     */
    public function getSerializationGroups(): array;

    /**
     * Gets the serialization version.
     *
     * @return string
     */
    public function getSerializationVersion(): string;

    /**
     * Gets the parameter.
     *
     * @return ParameterInterface
     */
    public function getParameter(): ParameterInterface;
}
