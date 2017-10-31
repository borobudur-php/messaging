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

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
abstract class Query extends Message
{
    private const DEFAULT_PAGE_SIZE = 50;

    /**
     * {@inheritdoc}
     */
    final public function getMessageType(): string
    {
        return MessageInterface::TYPE_QUERY;
    }

    /**
     * Add paginate metadata to query message.
     *
     * @param int $pageSize
     *
     * @return Query|static
     */
    final public function paginate(int $pageSize = self::DEFAULT_PAGE_SIZE): Query
    {
        return $this->addMessageMetadata('page_size', $pageSize);
    }

    /**
     * Gets the page size.
     *
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->getMessageMetadata()->get('page_size');
    }

    /**
     * Check whether message has paginate or not.
     *
     * @return bool
     */
    final public function isPaginated(): bool
    {
        return null !== $this->getMessageMetadata()->get('page_size');
    }
}
