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
interface RegistryInterface
{
    /**
     * Gets all the metadata in registry.
     *
     * @return MetadataInterface[]
     */
    public function getAll(): array;

    /**
     * Gets the metadata from specified alias.
     *
     * @param string $alias
     *
     * @return MetadataInterface
     */
    public function get(string $alias): MetadataInterface;

    /**
     * Gets the metadata from specified message class.
     *
     * @param string $message
     *
     * @return MetadataInterface
     */
    public function getByMessage(string $message): MetadataInterface;

    /**
     * Register a metadata to registry.
     *
     * @param MetadataInterface $metadata
     */
    public function add(MetadataInterface $metadata): void;

    /**
     * Parse and register metadata by configuration.
     *
     * @param string $alias
     * @param array  $configuration
     */
    public function addFromAliasAndConfiguration(string $alias, array $configuration): void;
}
