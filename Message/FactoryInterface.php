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

use Borobudur\Component\Messaging\Metadata\MetadataInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface FactoryInterface
{
    /**
     * Create a message from metadata.
     *
     * @param MetadataInterface $metadata
     * @param array             $data
     *
     * @return MessageInterface|mixed
     */
    public function createFromMetadata(MetadataInterface $metadata, array $data): MessageInterface;
}
