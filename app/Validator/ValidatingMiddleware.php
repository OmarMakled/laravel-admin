<?php

declare (strict_types = 1);

/*
 * This file is part of Alt Three Validator.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Validator;

use App\Validator\ValidatingTrait;
use Closure;
use Illuminate\Contracts\Validation\Factory;

/**
 * This is the command validating middleware class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ValidatingMiddleware
{
    /**
     * The validation factory instance.
     *
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $factory;

    /**
     * Create a new validating middleware instance.
     *
     * @param \Illuminate\Contracts\Validation\Factory $factory
     *
     * @return void
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Validate the command before execution.
     *
     * @param object   $command
     * @param \Closure $next
     *
     * @throws \AltThree\Validator\ValidationException
     *
     * @return void
     */
    public function handle($command, Closure $next)
    {
        if (array_get(class_uses($command), ValidatingTrait::class)) {
            $this->validate($command);
        }

        return $next($command);
    }

    /**
     * Validate the command.
     *
     * @param object $command
     *
     * @throws \AltThree\Validator\ValidationException
     *
     * @return void
     */
    protected function validate($command)
    {
        $validator = $this->factory->make($command->getData(), $command->getRules());

        if ($validator->fails()) {
            throw new ValidationException($validator->getMessageBag());
        }
    }
}
