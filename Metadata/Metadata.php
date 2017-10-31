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

namespace Borobudur\Component\Messaging\Metadata;

use Borobudur\Component\Parameter\ImmutableParameter;
use Borobudur\Component\Parameter\ParameterInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class Metadata implements MetadataInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $applicationName;

    /**
     * @var ParameterInterface
     */
    private $parameters;

    private function __construct(string $name, string $applicationName, array $parameters)
    {
        $this->name = $name;
        $this->applicationName = $applicationName;
        $this->parameters = new ImmutableParameter($parameters);
    }

    public static function fromAliasAndConfiguration(string $alias, array $parameters): MetadataInterface
    {
        list($applicationName, $name) = self::parseAlias($alias);

        return new Metadata($name, $applicationName, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return $this->applicationName.'.'.$this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getApplicationName(): string
    {
        return $this->applicationName;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessageClass(): string
    {
        return $this->parameters->get('classes')['message'];
    }

    /**
     * {@inheritdoc}
     */
    public function getHandlerClass(): string
    {
        return $this->parameters->get('classes')['handler'];
    }

    /**
     * {@inheritdoc}
     */
    public function getFactoryClass(): string
    {
        return $this->parameters->get('classes')['factory'];
    }

    /**
     * {@inheritdoc}
     */
    public function getServiceId(string $serviceName): string
    {
        return $this->applicationName.'.'.$serviceName.'.'.$this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter(): ParameterInterface
    {
        return $this->parameters;
    }

    private static function parseAlias(string $alias): array
    {
        if (false === strpos($alias, '.')) {
            throw new \InvalidArgumentException(
                'Invalid alias supplied, it should conform to the following format "<applicationName>.<name>"'
            );
        }

        $parts = explode('.', $alias);
        $applicationName = $parts[0];
        array_splice($parts, 0, 1);
        $alias = implode('.', $parts);

        return [$applicationName, $alias];
    }
}
