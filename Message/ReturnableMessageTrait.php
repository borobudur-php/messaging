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
trait ReturnableMessageTrait
{
    /**
     * @var mixed
     */
    private $return;

    /**
     * {@inheritdoc}
     */
    public function setMessageReturn($return): void
    {
        $this->return = $return;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessageReturn()
    {
        return $this->return;
    }
}
