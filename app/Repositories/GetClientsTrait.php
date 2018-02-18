<?php

namespace CodeFin\Repositories;

/**
 * Trait GetClientsTrait
 * @package CodeFin\Repositories
 * @author Adan Felipe Medeiros <adan.grg@gmail.com>
 */
trait GetClientsTrait
{
    private function getClients()
    {
        $repository = app(\CodeFin\Repositories\ClientRepository::class);
        $repository->skipPresenter(true);
        return $repository->all();
    }
}