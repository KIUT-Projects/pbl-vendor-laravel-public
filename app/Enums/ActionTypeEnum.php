<?php

namespace App\Enums;

enum ActionTypeEnum:string
{
    const account = 'account';
    const product = 'product';
    const order = 'order';
    const user = 'user';
    const brand = 'brand';
    const supplier = 'supplier';
}
