@extends('layouts.admin')

@section('content')


    <div class="row">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                                <div class="mb-xl-0 mb-4">
                                    <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                        <span class="app-brand-text fw-bold fs-4"> VENDER</span>
                                    </div>
                                    <p class="mb-2">Vender Market</p>
                                    <p class="mb-2">Yakkasaroy filiyali</p>
                                    <p class="mb-0">+998 (95) 000 04 09 , +998 (93) 836 61 11</p>
                                </div>
                                <div>
                                    <h4 class="fw-semibold mb-2">INVOICE #{{ $order->id  }}</h4>
                                    <div class="mb-2 pt-1">
                                        <span>Date Issues:</span>
                                        <span class="fw-semibold">{{ $order->created_at->format('d.m.Y') }}</span>
                                    </div>
                                    <div class="pt-1">
                                        <span>Date Due:</span>
                                        <span class="fw-semibold">{{ $order->updated_at->format('d.m.Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <div class="row p-sm-3 p-0">
                                <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                                    <h6 class="mb-3">Invoice To:</h6>
                                    <p class="mb-1">Thomas shelby</p>
                                    <p class="mb-1">Shelby Company Limited</p>
                                    <p class="mb-1">Small Heath, B10 0HF, UK</p>
                                    <p class="mb-1">718-986-6062</p>
                                    <p class="mb-0">peakyFBlinders@gmail.com</p>
                                </div>

                        </div>
                        <div class="table-responsive border-top">
                            <table class="table m-0">
                                <thead>

                                <tr>
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th>Cost</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                                </thead>


                                <tbody>

                                @foreach($order->orderItems as $item)

                                    <tr>
                                        <td><img src="{{ asset($item->product->image) }} "style="max-width: 50px;" class="img-fluid"></td>
                                    <td class="text-nowrap">{{ $item->product->name }}</td>
                                    <td>{{price( $item->product->price ?? '0') }}</td>

                                    <td>{{ (int)$item->quantity }}</td>
                                    <td>{{ price( $item->price*$item->quantity ?? '0') }}</td>
                                </tr>
                                @endforeach
                                    <td colspan="3" class="align-top px-4 py-4">
                                        <p class="mb-2 mt-3">
                                            <span class="ms-3 fw-semibold">Salesperson:</span>
                                            <span>s</span>
                                        </p>
                                        <span class="ms-3">Thanks for your buy</span>
                                    </td>
                                    <td class="text-end pe-3 py-4">
                                        <p class="mb-2 pt-3">Subtotal:</p>
                                        <p class="mb-2">Discount:</p>
                                        <p class="mb-2">Tax:</p>
                                        <p class="mb-0 pb-3">Total:</p>
                                    </td>
                                    <td class="ps-2 py-4">
                                        <p class="fw-semibold mb-2 pt-3">{{price($order->price ?? '0')}}</p>
                                        <p class="fw-semibold mb-2">{{price('0')}}</p>
                                        <p class="fw-semibold mb-2">{{price('0')}}</p>
                                        <p class="fw-semibold mb-0 pb-3">{{price($order->price ?? '0')}}</p>
                                    </td>


                                </tbody>

                            </table>
                        </div>

                        <div class="card-body mx-3">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fw-semibold">Note:</span>
                                    <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                            future freelance projects. Thank You!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    </div>
@endsection
