<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductDetailRequest;
use App\Http\Requests\UpdateProductDetailRequest;
use App\Models\ProductDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductDetailRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductDetail $productDetail): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductDetail $productDetail): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductDetailRequest $request, ProductDetail $productDetail): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductDetail $productDetail): RedirectResponse
    {
        //
    }
}
