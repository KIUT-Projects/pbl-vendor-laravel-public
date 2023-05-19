@extends('layouts.admin')

@section('content')

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-12 col-md-8 col-8 mb-md-0 mb-4">
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
                                    <h4 class="fw-semibold mb-2"> {{ __('INVOICE') }} #{{ 1000+$order->id  }}</h4>
                                    <div class="mb-2 pt-1">
                                        <span>{{ __('Cashier') }}:</span>
                                        <span class="fw-semibold">{{ $order->user->name ?? 'Customer'}}</span>
                                    </div>
                                    <div class="mb-2 pt-1">
                                        <span>{{ __('Date Issues') }}:</span>
                                        <span class="fw-semibold">{{ $order->created_at->format('d.m.Y') }}</span>
                                    </div>
                                    <div class="pt-1">
                                        <span>{{ __('Date Due') }}:</span>
                                        <span class="fw-semibold">{{ $order->updated_at->format('d.m.Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="table-responsive border-top">
                            <table class="table m-0">
                                <thead>

                                <tr>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Item') }}</th>
                                    <th>{{ __('Cost') }}</th>
                                    <th>{{ __('Qty') }}</th>
                                    <th>{{ __('Price') }}</th>
                                </tr>
                                </thead>


                                <tbody>

                                @foreach($order->orderItems as $item)

                                    <tr>
                                        <td><img src="{{ asset($item->product->image) }} "style="max-width: 80px;" class="img-fluid"></td>
                                    <td class="text-nowrap">{{ $item->product->name }}</td>
                                    <td>{{price( $item->product->price ?? '0') }}</td>

                                    <td>{{ (int)$item->quantity }}</td>
                                    <td>{{ price( $item->price*$item->quantity ?? '0') }}</td>
                                </tr>
                                @endforeach
                                    <td colspan="3" class="align-top px-4 py-4">
                                        <p class="mb-2 mt-3">
                                            <span class="ms-3 fw-semibold">{{ __('Salesperson') }}:</span>
                                            <span>{{ __('') }}</span>
                                        </p>
                                        <span class="ms-3">{{ __('Thanks for your buy') }}</span>
                                    </td>
                                    <td class="text-end pe-3 py-4">
                                        <p class="mb-2 pt-3">{{ __('Subtotal') }}:</p>
                                        <p class="mb-2">{{ __('Discount') }}:</p>
                                        <p class="mb-2">{{ __('Tax') }}:</p>
                                        <p class="mb-0 pb-3">{{ __('Total') }}:</p>
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

                    </div>
                </div>
            </div>
@endsection
