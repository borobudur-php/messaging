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

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface ConfigurationFactoryInterface
{
    /**
     * Create request configuration from request.
     *
     * @param RequestInterface $request
     *
     * @return ConfigurationInterface
     */
    public function createFrom(RequestInterface $request): ConfigurationInterface;
}
