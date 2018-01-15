<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Repositories\BankRepository;

class BankController extends Controller
{
    /**
     * @var BankRepository
     */
    private $repository;

    /**
     * BankController constructor.
     * @param BankRepository $repository
     */
    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json(['data' => $this->repository->all()]);
    }
}