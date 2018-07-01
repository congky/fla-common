<?php
namespace FLA\Common\Controllers;

use FLA\Core\BaseControllers;
use FLA\Core\CoreException;
use FLA\Core\Util\DateUtil;
use FLA\Core\Util\ResponseUtil;
use FLA\Core\Util\SessionUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ServiceController extends BaseControllers
{

    public function call(Request $request)
    {
        try {

            $service = App::make($request->get('service'));

            $input = $request["payload"];
            $input["_header"] = [
                // client info
                "platform"=>$request["platform"],
                "platformVersion"=>$request["platformVersion"],
                "browser"=>$request["browser"],
                "browserVersion"=>$request["browserVersion"],
                "countryCode"=>$request["countryCode"],
                "countryName"=>$request["countryName"],
                "regionCode"=>$request["regionCode"],
                "regionName"=>$request["regionName"],
                "cityName"=>$request["cityName"],
                "zipCode"=>$request["zipCode"],
                "isoCode"=>$request["isoCode"],
                "postalCode"=>$request["postalCode"],
                "latitude"=>$request["latitude"],
                "longitude"=>$request["longitude"],
                "metroCode"=>$request["metroCode"],
                "areaCode"=>$request["areaCode"],

                // user info
                "username"=>SessionUtil::getUsername(),
                "userLoginId"=>SessionUtil::getUserLoginId(),
                "userRoleId"=>SessionUtil::getCurrentRoleId(),
                "datetime"=>DateUtil::currentDatetime(),
                "date"=>DateUtil::currentDate(),
            ];

            $response = $service->execute($input);

            return ResponseUtil::isOk($response);

        } catch (CoreException $ex) {
            return ResponseUtil::isFail($ex);
        }
    }

}