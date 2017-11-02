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
use Psr\Container\ContainerInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * @author  Iqbal Maulana <iq.bluejack@gmail.com>
 */
final class ParameterParser implements ParameterParserInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var ExpressionLanguage
     */
    private $expression;

    public function __construct(ContainerInterface $container, ExpressionLanguage $expression)
    {
        $this->container = $container;
        $this->expression = $expression;
    }

    /**
     * {@inheritdoc}
     */
    public function parseRequestValues(array $parameters, RequestInterface $request): array
    {
        return array_map(
            function ($parameter) use ($request) {
                if (is_array($parameter)) {
                    return $this->parseRequestValues($parameter, $request);
                }

                return $this->parseRequestValue($parameter, $request);
            },
            $parameters
        );
    }

    private function parseRequestValue($parameter, RequestInterface $request)
    {
        if (0 === strpos($parameter, '$')) {
            return $request->get(substr($parameter, 1));
        }

        if (0 === strpos($parameter, 'expr:')) {
            return $this->parseRequestValueExpression(
                substr($parameter, 5),
                $request
            );
        }

        return $parameter;
    }

    /**
     * Parse request value with expression.
     *
     * @param string           $expression
     * @param RequestInterface $request
     *
     * @return string
     */
    private function parseRequestValueExpression(string $expression, RequestInterface $request): string
    {
        $expression = preg_replace_callback(
            '/(\$\w+)/',
            function ($matches) use ($request) {
                $variable = $request->get(substr($matches[1], 1));

                if (is_array($variable) || is_object($variable)) {
                    throw new \InvalidArgumentException(
                        sprintf(
                            'Cannot use %s ($%s) as parameter in expression.',
                            gettype($variable),
                            $matches[1]
                        )
                    );
                }

                return is_string($variable) ? sprintf('"%s"', $variable)
                    : $variable;
            },
            $expression
        );

        return $this->expression->evaluate(
            $expression,
            ['container' => $this->container]
        );
    }
}
