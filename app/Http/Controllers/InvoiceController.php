<?php

namespace App\Http\Controllers;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    private InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository) 
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => $this->invoiceRepository->getAllInvoices()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();
        return response()->json([
                'data' => $this->invoiceRepository->createInvoice($validated)
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => $this->invoiceRepository->getInvoiceById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, $id)
    {
        $validated = $request->validated();
        return response()->json([
            'data' => $this->invoiceRepository->updateInvoice($id, $validated)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->invoiceRepository->deleteInvoice($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Change status the specified invoice to paid.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoicePaid($id)
    {
        $this->invoiceRepository->invoicePaid($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
