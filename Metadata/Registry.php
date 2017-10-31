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

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class Registry implements RegistryInterface
{
    /**
     * @var MetadataInterface[]
     */
    private $metadata = [];

    /**
     * @var string[]
     */
    private $aliases = [];

    /**
     * {@inheritdoc}
     */
    public function getAll(): array
    {
        return $this->metadata;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $alias): MetadataInterface
    {
        if (!array_key_exists($alias, $this->metadata)) {
            throw new \InvalidArgumentException(
                sprintf('Resource "%s" does not exist', $alias)
            );
        }

        return $this->metadata[$alias];
    }

    /**
     * {@inheritdoc}
     */
    public function getByMessage(string $message): MetadataInterface
    {
        if (!array_key_exists($message, $this->aliases)) {
            throw new \InvalidArgumentException(
                sprintf('Resource with message "%s" does not exist', $message)
            );
        }

        return $this->get($this->aliases[$message]);
    }

    /**
     * {@inheritdoc}
     */
    public function add(MetadataInterface $metadata): void
    {
        $this->metadata[$metadata->getAlias()] = $metadata;
        $this->aliases[$metadata->getMessageClass()] = $metadata->getAlias();
    }

    /**
     * {@inheritdoc}
     */
    public function addFromAliasAndConfiguration(string $alias, array $configuration): void
    {
        $this->add(Metadata::fromAliasAndConfiguration($alias, $configuration));
    }
}
