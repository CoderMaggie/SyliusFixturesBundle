<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Bundle\FixturesBundle\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

abstract class AbstractFixture implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    final public function getConfigTreeBuilder(): TreeBuilder
    {
        if (method_exists(TreeBuilder::class, 'getRootNode')) {
            $treeBuilder = new TreeBuilder($this->getName());

            /** @var ArrayNodeDefinition $optionsNode */
            $optionsNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $treeBuilder = new TreeBuilder();

            /** @var ArrayNodeDefinition $optionsNode */
            $optionsNode = $treeBuilder->root($this->getName());
        }

        $this->configureOptionsNode($optionsNode);

        return $treeBuilder;
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        // empty
    }
}
