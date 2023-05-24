<?php

namespace App\Enums;

enum ActionMethodEnum:string
{
    const create = 'create';
    const edit = 'edit';
    const show = 'show';
    const delete = 'delete';
    const duplicate = 'duplicate';
    const analyze = 'analyze';
    const login = 'login';
    const logout = 'logout';
    const register = 'register';
    const verify = 'verify';
}
