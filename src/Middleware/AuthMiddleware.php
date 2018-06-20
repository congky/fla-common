<?php
namespace FLA\Common\Middleware;

use FLA\Common\CommonConstant;
use FLA\Core\GeneralConstant;
use FLA\Core\Middleware\AbstractMiddleware;
use Illuminate\Support\Facades\Cookie;

class AuthMiddleware extends AbstractMiddleware
{

    protected function beforeRequest($request)
    {
    }

    protected function afterRequest($request, &$response)
    {
        if (GeneralConstant::_OK == $request["_status"]) {

            $path = $request->path();

            if (CommonConstant::_PATH_LOGIN_API == $path) {

                $response->withCookie(Cookie::forever('FLA-TOKEN', $request["FLA-TOKEN"], null, null, false, false));

            } elseif (CommonConstant::_PATH_LOGOUT_API == $path) {

                $response->withCookie(Cookie::forget('FLA-TOKEN'));

            }
        }
    }
}