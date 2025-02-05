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

namespace Sylius\Bundle\UserBundle\Provider;

use Symfony\Component\Security\Core\User\UserInterface;
use Webmozart\Assert\Assert;

class UsernameOrEmailProvider extends AbstractUserProvider
{
    protected function findUser(string $uniqueIdentifier): ?UserInterface
    {
        if (filter_var($uniqueIdentifier, \FILTER_VALIDATE_EMAIL)) {
            $user = $this->userRepository->findOneByEmail($uniqueIdentifier);
            Assert::nullOrIsInstanceOf($user, UserInterface::class);

            return $user;
        }

        $user = $this->userRepository->findOneBy(['usernameCanonical' => $uniqueIdentifier]);
        Assert::nullOrIsInstanceOf($user, UserInterface::class);

        return $user;
    }
}
