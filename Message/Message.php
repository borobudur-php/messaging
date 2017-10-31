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

use Borobudur\Component\Parameter\ParameterInterface;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
abstract class Message implements MessageInterface, PayloadMessageInterface, MetadataMessageInterface
{
    use PayloadTrait;

    /**
     * @var ParameterInterface
     */
    private $messageMetadata;

    final public function __construct(array $payload, array $metadata = null)
    {
        $this->setMessagePayload($payload);

        if (null !== $metadata) {
            $this->messageMetadata = $metadata;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getMessageMetadata(): ?ParameterInterface
    {
        return $this->messageMetadata;
    }

    /**
     * {@inheritdoc}
     *
     * @return MetadataMessageInterface|static
     */
    public function setMessageMetadata(array $metadata): MetadataMessageInterface
    {
        $payload = $this->getMessagePayloadOrigin()->all();

        return new static($payload, $metadata);
    }

    /**
     * {@inheritdoc}
     *
     * @return MetadataMessageInterface|static
     */
    public function addMessageMetadata(string $key, $value): MetadataMessageInterface
    {
        $payload = $this->getMessagePayloadOrigin()->all();
        $metadata = $this->messageMetadata;
        $metadata[$key] = $value;

        return new static($payload, $metadata);
    }

    /**
     * Use this method to initialize message with defaults or extend class
     */
    protected function init(): void
    {
    }
}
