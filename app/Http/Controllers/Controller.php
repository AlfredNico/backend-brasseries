<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Brasseries - CAMEROUN",
 *      description=" OpenApi description for Brasseries - CAMEROUN",
 *      @OA\Contact(
 *          name="CAMTRACK - DEV",
 *          url="https://camtrack.net/",
 *          email="alfred.andrianjatovo@camtrack.mg"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Brasseries API Sources"
 * )
 * @OA\SecurityScheme(
 *      type="http",
 *      description="Authentication Bearer Token",
 *      name="Authorization",
 *      in="header",
 *      bearerFormat="JWT",
 *      securityScheme="bearerAuth",
 *      scheme="bearer",
 * )
 * @OA\Tag(
 *     name="BRASSERIES",
 *     description="API Endpoints of Brasseries - CAMEROUN"
 * )
*/
class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
