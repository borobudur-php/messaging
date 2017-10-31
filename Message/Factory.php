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
use Ramsey\Uuid\Uuid;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class Factory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createFromMetadata(MetadataInterface $metadata, array $data): MessageInterface
    {
        if ($ids = $metadata->getParameter()->get('generate_ids')) {
            foreach ((array) $ids as $id) {
                $data[$id] = (string) Uuid::uuid4();
            }
        }

        $class = $metadata->getMessageClass();

        return new $class($data);
    }
}
