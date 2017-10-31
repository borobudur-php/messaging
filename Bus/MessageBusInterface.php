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

namespace Borobudur\Component\Messaging\Bus;

use Borobudur\Component\Messaging\Message\MessageInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface MessageBusInterface
{
    /**
     * Dispatch given message.
     *
     * @param MessageInterface $message
     *
     * @return mixed
     */
    public function dispatch(MessageInterface $message);
}
