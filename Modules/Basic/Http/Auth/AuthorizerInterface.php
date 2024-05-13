<?php
namespace Modules\Basic\Http\Auth;
/**
 * 授權介面
 */
interface AuthorizerInterface
{
    public function hasPermission(array $roles) : bool;
}
