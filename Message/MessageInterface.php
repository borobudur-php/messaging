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
interface MessageInterface
{
    public const TYPE_COMMAND = 'command';

    public const TYPE_EVENT = 'event';

    public const TYPE_QUERY = 'query';

    /**
     * Gets the message type.
     *
     * @return string
     */
    public function getMessageType(): string;
}
