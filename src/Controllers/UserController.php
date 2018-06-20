<?php
namespace FLA\Common\Controllers;

use FLA\Common\BusinessObject\BusinessFunction\user\CountUserListAdvance;
use FLA\Common\BusinessObject\BusinessFunction\user\GetUserInfoByToken;
use FLA\Common\BusinessObject\BusinessFunction\user\GetUserListAdvance;
use FLA\Common\BusinessObject\BusinessTransaction\role\AddRole;
use FLA\Common\BusinessObject\BusinessTransaction\role\EditRole;
use FLA\Common\BusinessObject\BusinessTransaction\role\RemoveRole;
use FLA\Core\BaseControllers;
use FLA\Core\CoreException;
use FLA\Core\GeneralConstant;
use Illuminate\Http\Request;

class UserController extends BaseControllers
{

    public function add(Request $request) {
        try {

            $input=[
                'userTypeId' => $request['username'],
                'username' => $request['username'],
                'fullName' => $request['fullName'],
                'email' => $request['email'],
                'password' => $request['email'],
                'rePassword' => $request['rePassword'],
                'phoneNumber' => $request['phoneNumber'],
                'religion' => $request['religion'],
                'dateOfBirth' => $request['dateOfBirth'],
                'placeOfBirth' => $request['placeOfBirth'],
                'country' => $request['country'],
                'fullAddress' => $request['fullAddress'],
                'userLoginId' => $request['userLoginId'],
                'roleLoginId' => $request['roleLoginId']
            ];

            $role = new AddRole();
            $resultAddRole = $role->execute($input);
            return response()->json([
                'status' => GeneralConstant::_OK,
                'response' => $resultAddRole
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => GeneralConstant::_FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(Request $request) {
        try {

            $input=[
                'id' => $request['id'],
                'roleName' => $request['roleName'],
                'roleDesc' => $request['roleDesc'],
                'active' => $request['active'],
                'userLoginId' => $request['userLoginId'],
                'roleLoginId' => $request['roleLoginId']
            ];

            $role = new EditRole();
            $resultEditRole = $role->execute($input);
            return response()->json([
                'status' => GeneralConstant::_OK,
                'response' => $resultEditRole
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => GeneralConstant::_FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function remove(Request $request) {
        try {

            $input=[
                'id' => $request['id'],
                'userLoginId' => $request['userLoginId'],
                'roleLoginId' => $request['roleLoginId']
            ];

            $role = new RemoveRole();
            $resultRemoveRole = $role->execute($input);
            return response()->json([
                'status' => GeneralConstant::_OK,
                'response' => $resultRemoveRole
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => GeneralConstant::_FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getUserListAdvance(Request $request)
    {
        try {
            $input=[
                'username' => $request['username']==null?GeneralConstant::_EMPTY_VALUE:$request['username'],
                'fullName' => $request['fullName']==null?GeneralConstant::_EMPTY_VALUE:$request['fullName'],
                'email' => $request['email']==null?GeneralConstant::_EMPTY_VALUE:$request['email'],
                'phoneNumber' => $request['phoneNumber']==null?GeneralConstant::_EMPTY_VALUE:$request['phoneNumber'],
                'limit' => $request['limit']==null?0:$request['limit'],
                'offset' => $request['offset']==null?0:$request['offset']
            ];

            $userList = new GetUserListAdvance();
            $resultUserList = $userList->execute($input);
            return response()->json([
                'status' => GeneralConstant::_OK,
                'response' => $resultUserList
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => GeneralConstant::_FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function countUserListAdvance(Request $request)
    {
        try {
            $input=[
                'username' => $request['username']==null?GeneralConstant::_EMPTY_VALUE:$request['username'],
                'fullName' => $request['fullName']==null?GeneralConstant::_EMPTY_VALUE:$request['fullName'],
                'email' => $request['email']==null?GeneralConstant::_EMPTY_VALUE:$request['email'],
                'phoneNumber' => $request['phoneNumber']==null?GeneralConstant::_EMPTY_VALUE:$request['phoneNumber']
            ];

            $userList = new CountUserListAdvance();
            $resultUserList = $userList->execute($input);
            return response()->json([
                'status' => GeneralConstant::_OK,
                'response' => $resultUserList
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => GeneralConstant::_FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getUserLoggedInfo(Request $request){
        try {

            $input=[
                'token' => $token = $request->header('FLA-TOKEN')
            ];
            // Get user info
            $getUserInfo = new GetUserInfoByToken();
            $userInfo = $getUserInfo->execute($input);

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

}