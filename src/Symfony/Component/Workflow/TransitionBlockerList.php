<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Workflow;

/**
 * A list of transition blockers.
 *
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 *
 * @implements \IteratorAggregate<int, TransitionBlocker>
 */
final class TransitionBlockerList implements \IteratorAggregate, \Countable
{
    private array $blockers;

    /**
     * @param TransitionBlocker[] $blockers
     */
    public function __construct(array $blockers = [])
    {
        $this->blockers = [];

        foreach ($blockers as $blocker) {
            $this->add($blocker);
        }
    }

    public function add(TransitionBlocker $blocker): void
    {
        $this->blockers[] = $blocker;
    }

    public function has(string $code): bool
    {
        return array_any($this->blockers, static fn (TransitionBlocker $blocker): bool => $code === $blocker->getCode());
    }

    public function clear(): void
    {
        $this->blockers = [];
    }

    public function isEmpty(): bool
    {
        return !$this->blockers;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->blockers);
    }

    public function count(): int
    {
        return \count($this->blockers);
    }
}
