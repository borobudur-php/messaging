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
abstract class Command extends Message
{
    final public function getMessageType(): string
    {
        return MessageInterface::TYPE_COMMAND;
    }
}
