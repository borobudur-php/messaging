<?php
/**
 * This file is part of the Borobudur package.
 *
 * (c) 2018 Borobudur <http://borobudur.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Borobudur\Component\Messaging\Message;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface ReturnableMessageInterface
{
    /**
     * @param mixed $return
     *
     * @return mixed
     */
    public function setMessageReturn($return): void;

    /**
     * @return mixed
     */
    public function getMessageReturn();
}
