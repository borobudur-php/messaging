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
use Borobudur\Component\Messaging\Metadata\RegistryInterface;
use Borobudur\Component\Messaging\ParameterParserInterface;
use Borobudur\Component\Parameter\Parameter;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class ConfigurationFactory implements ConfigurationFactoryInterface
{
    private const API_VERSION_HEADER = 'Accept';

    private const API_GROUPS_HEADER = 'Accept';

    private const API_VERSION_REGEXP = '/(v|version)=(?P<version>[0-9\.]+)/i';

    private const API_GROUPS_REGEXP = '/(g|groups)=(?P<groups>[a-z,_\s]+)/i';

    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * @var ParameterParserInterface
     */
    private $parameterParser;

    /**
     * @var array
     */
    private $defaultParameters;

    public function __construct(RegistryInterface $registry, ParameterParserInterface $parameterParser, array $defaultParameters = null)
    {
        $this->registry = $registry;
        $this->parameterParser = $parameterParser;
        $this->defaultParameters = $defaultParameters;
    }

    /**
     * {@inheritdoc}
     */
    public function createFrom(RequestInterface $request): ConfigurationInterface
    {
        $parameters = array_merge(
            $this->defaultParameters,
            $this->parseParameters($request)
        );
        $parameters = $this->parameterParser->parseRequestValues(
            $parameters,
            $request
        );
        $metadata = $this->registry->get($parameters['message']);

        return new Configuration(
            $metadata,
            $request,
            new Parameter($parameters)
        );
    }

    /**
     * Parse the parameter with given request.
     *
     * @param RequestInterface $request
     *
     * @return array
     */
    private function parseParameters(RequestInterface $request): array
    {
        $parameters = [];
        $versionHeader = reset($request->getHeader(self::API_VERSION_HEADER));
        $groupHeader = reset($request->getHeader(self::API_GROUPS_HEADER));

        if (preg_match(self::API_VERSION_REGEXP, $versionHeader, $matches)) {
            $parameters['serialization_version'] = $matches['version'];
        }

        if (preg_match(self::API_GROUPS_REGEXP, $groupHeader, $matches)) {
            $parameters['serialization_groups'] = array_map(
                'trim',
                explode(',', $matches['groups'])
            );
        }

        return array_merge(
            $request->get('_borobudur', []),
            $parameters
        );
    }
}
