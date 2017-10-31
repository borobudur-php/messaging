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
use Borobudur\Component\Messaging\Metadata\MetadataInterface;
use Borobudur\Component\Parameter\ParameterInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class Configuration implements ConfigurationInterface
{
    /**
     * @var MetadataInterface
     */
    private $metadata;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ParameterInterface
     */
    private $parameter;

    public function __construct(MetadataInterface $metadata, RequestInterface $request, ParameterInterface $parameter)
    {
        $this->metadata = $metadata;
        $this->request = $request;
        $this->parameter = $parameter;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetadata(): MetadataInterface
    {
        return $this->metadata;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * {@inheritdoc}
     */
    public function isHtmlRequest(): bool
    {
        return 'html' === $this->request->getRequestFormat();
    }

    /**
     * {@inheritdoc}
     */
    public function getSerializationGroups(): array
    {
        return $this->parameter->get('serialization_groups', []);
    }

    /**
     * {@inheritdoc}
     */
    public function getSerializationVersion(): string
    {
        return $this->parameter->get('serialization_version');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter(): ParameterInterface
    {
        return $this->parameter;
    }
}
