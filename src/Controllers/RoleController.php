<?php
namespace FLA\Common\Controllers;

use FLA\Common\BusinessObject\BusinessFunction\role\CountRoleListAdvance;
use FLA\Common\BusinessObject\BusinessFunction\role\GetRoleListAdvance;
use FLA\Common\BusinessObject\BusinessTransaction\role\AddRole;
use FLA\Common\BusinessObject\BusinessTransaction\role\EditRole;
use FLA\Common\BusinessObject\BusinessTransaction\role\RemoveRole;
use FLA\Core\BaseControllers;
use FLA\Core\CoreException;
use FLA\Core\GeneralConstant;
use Illuminate\Http\Request;

class RoleController extends BaseControllers
{

    public function add(Request $request) {
        try {

            $input=[
                'roleCode' => $request['roleCode'],
                'roleName' => $request['roleName'],
                'roleDesc' => $request['roleDesc'],
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

    public function getRoleListAdvance(Request $request)
    {
        try {

            $input=[
                'code' => $request['code'],
                'name' => $request['name'],
                'desc' => $request['desc'],
                'limit' => $request['limit'],
                'offset' => $request['offset']
            ];

            $roleList = new GetRoleListAdvance();
            $resultRoleList = $roleList->execute($input);
            return response()->json([
                'status' => GeneralConstant::_OK,
                'response' => $resultRoleList
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => GeneralConstant::_FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function countRoleListAdvance(Request $request)
    {
        try {

            $input=[
                'code' => $request['code'],
                'name' => $request['name'],
                'desc' => $request['desc']
            ];

            $roleList = new CountRoleListAdvance();
            $resultRoleList = $roleList->execute($input);
            return response()->json([
                'status' => GeneralConstant::_OK,
                'response' => $resultRoleList
            ]);

        } catch (CoreException $e) {
            return response()->json([
                'status' => GeneralConstant::_FAIL,
                'message' => $e->getMessage()
            ]);
        }
    }

}