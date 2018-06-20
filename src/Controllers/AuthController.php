<?php
namespace FLA\Common\Controllers;

use FLA\Common\BusinessObject\BusinessFunction\user\GetUserInfoByToken;
use FLA\Common\BusinessObject\BusinessTransaction\user\AuthUserLogin;
use FLA\Common\BusinessObject\BusinessTransaction\user\DestroyUserLogin;
use FLA\Core\BaseControllers;
use FLA\Core\CoreException;
use FLA\Core\GeneralConstant;
use Illuminate\Http\Request;

class AuthController extends BaseControllers
{

    public function login(Request $request)
    {
        try {

            $device = $request["platform"]." ".$request["platformVersion"];
            $browser = $request["browser"]." ".$request["browserVersion"];

            $input=[
                'usernameOrEmail' => $request['username'],
                'password' => $request['password'],
                'ip' => $request->ip(),
                'device' => $device,
                'browser' => $browser
            ];

            // Auth login
            $authUser = new AuthUserLogin();
            $userLoggedInfo = $authUser->execute($input);

            // Get user info
            $getUserInfo = new GetUserInfoByToken();
            $userInfo = $getUserInfo->execute([
                'token' => $userLoggedInfo['user_token']
            ]);

            $request["FLA-TOKEN"] = $userLoggedInfo['user_token'];

            return response()->json([
                'status' => GeneralConstant::_OK,
                'response' => $userInfo
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => GeneralConstant::_FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {

        try {

            $destroyUserLogin = new DestroyUserLogin();
            $destroyUserLogin->execute([
                'userToken' => $_COOKIE['FLA-TOKEN']
            ]);

            return response()->json([
                'status' => GeneralConstant::_OK
            ]);
        } catch (CoreException $e) {
            return response()->json([
                'status' => GeneralConstant::_FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

}