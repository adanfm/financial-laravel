<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Controllers\Response;
use Illuminate\Http\Request;

use CodeFin\Http\Requests;
use CodeFin\Http\Requests\BillReceiveCreateRequest;
use CodeFin\Http\Requests\BillReceiveUpdateRequest;
use CodeFin\Repositories\BillReceiveRepository;


class BillReceivesController extends Controller
{

    /**
     * @var BillReceiveRepository
     */
    protected $repository;

    public function __construct(BillReceiveRepository $repository)
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
        $billReceives = $this->repository->paginate(8);

        return $billReceives;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BillReceiveCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BillReceiveCreateRequest $request)
    {
        $dataRequest = $request->all();

        if (isset($dataRequest['date_due'])) {
            $date = \DateTIme::createFromFormat('d/m/Y', $dataRequest['date_due']);
            $dataRequest['date_due'] = $date->format('Y-m-d');
        }

        $billReceives = $this->repository->create($dataRequest);
        return response()->json($billReceives, 201);
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
        $billReceives = $this->repository->find($id);
        return $billReceives;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BillReceiveUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BillReceiveUpdateRequest $request, $id)
    {
        $dataRequest = $request->all();

        if (isset($dataRequest['date_due'])) {
            $date = \DateTIme::createFromFormat('d/m/Y', $dataRequest['date_due']);
            $dataRequest['date_due'] = $date->format('Y-m-d');
        }

        $billReceives = $this->repository->update($dataRequest, $id);
        return response()->json($billReceives);
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
