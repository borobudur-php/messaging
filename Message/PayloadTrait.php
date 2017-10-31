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

use Borobudur\Component\Parameter\ImmutableParameter;
use Borobudur\Component\Parameter\ParameterInterface;
use ReflectionProperty;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
trait PayloadTrait
{
    /**
     * @var ParameterInterface
     */
    private $payload;

    /**
     * @var ParameterInterface
     */
    private $payloadOrigin;

    /**
     * {@inheritdoc}
     */
    public function getMessagePayload(): ?ParameterInterface
    {
        return $this->payload;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessagePayloadOrigin(): ?ParameterInterface
    {
        return $this->payloadOrigin;
    }

    /**
     * Filter and set payload message.
     *
     * @param array $payload
     */
    protected function setMessagePayload(array $payload): void
    {
        $this->payloadOrigin = new ImmutableParameter($payload);
        $temp = [];

        foreach ($payload as $key => $value) {
            $property = $this->toCamelCase($key);

            if (property_exists($this, $property)) {
                $this->setPropValue($property, $value);
                $temp[$key] = $value;
            }
        }

        $this->payload = new ImmutableParameter($temp);
    }

    /**
     * Convert snake case to camel case.
     *
     * @param string $value
     *
     * @return string
     */
    private function toCamelCase(string $value): string
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return lcfirst(str_replace(' ', '', $value));
    }

    /**
     * Sets value by specified key.
     *
     * @param string $key
     * @param mixed  $value
     */
    private function setPropValue(string $key, $value): void
    {
        $property = new ReflectionProperty(get_class($this), $key);
        $property->setAccessible(true);
        $property->setValue($this, $value);
    }
}
