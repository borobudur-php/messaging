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

namespace Borobudur\Component\Messaging\Message;

use Borobudur\Component\Parameter\ParameterInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface MetadataMessageInterface
{
    /**
     * Gets message metadata.
     *
     * @return ParameterInterface|null
     */
    public function getMessageMetadata(): ?ParameterInterface;

    /**
     * Sets and replaces current metadata with new metadata.
     *
     * @param array $metadata
     *
     * @return MessageInterface|static
     */
    public function setMessageMetadata(array $metadata): MetadataMessageInterface;

    /**
     * Append current message metadata.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return MessageInterface|static
     */
    public function addMessageMetadata(string $key, $value): MetadataMessageInterface;
}
