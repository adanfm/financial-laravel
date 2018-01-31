<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Controllers\Response;
use Illuminate\Http\Request;

use CodeFin\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CodeFin\Http\Requests\BillPaysCreateRequest;
use CodeFin\Http\Requests\BillPaysUpdateRequest;
use CodeFin\Repositories\BillPaysRepository;
use CodeFin\Validators\BillPaysValidator;


class BillPaysController extends Controller
{

    /**
     * @var BillPaysRepository
     */
    protected $repository;

    public function __construct(BillPaysRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billPays = $this->repository->paginate(8);

        return $billPays;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BillPaysCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BillPaysCreateRequest $request)
    {
        $billPays = $this->repository->create($request->all());
        return response()->json($billPays, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $billPays = $this->repository->find($id);
        return $billPays;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BillPaysUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BillPaysUpdateRequest $request, $id)
    {
        $billPays = $this->repository->update($request->all(), $id);
        return response()->json($billPays);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json([], 204);
    }
}
