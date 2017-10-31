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

namespace Borobudur\Component\Messaging;

use Borobudur\Component\Http\RequestInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
interface ParameterParseInterface
{
    /**
     * Parse request values to parameter.
     *
     * @param array            $parameters
     * @param RequestInterface $request
     *
     * @return array
     */
    public function parseRequestValues(array $parameters, RequestInterface $request): array;
}
