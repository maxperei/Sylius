<?php

declare(strict_types=1);

namespace Sylius\Bundle\CoreBundle\DataFixtures\Factory;

interface WithCurrenciesInterface
{
    /**
     * @return $this
     */
    public function withCurrencies(array $currencies): self;
}
