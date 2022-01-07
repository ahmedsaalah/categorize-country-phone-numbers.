<?php


namespace App\Services;

use Illuminate\Http\Response;
use App\Constants\Error;
use App\Constants\ResponseKey;


use Illuminate\Pagination\LengthAwarePaginator;


class GeneralService
{


    /**
     * Gets a response object for any error that occurs through out the application
     * 
     * @param array $errorIdArr
     * @param int $responseCode
     * @param array $validationErrors
     * @param array $dataArr
     * @return Illuminate\Http\Response
     */
    public static function getErrorResponse($errorIdArr, $responseCode = Response::HTTP_OK, $validationErrors = null, $dataArr = array(), $uuid = null)
    {
        $errorArr = GeneralService::getErrorArray($errorIdArr, $dataArr, $uuid);
        $result = array(ResponseKey::STATUS => 0, ResponseKey::ERRORS => $errorArr);
        if (is_array($validationErrors)) {
            $result[ResponseKey::VALIDATION] = $validationErrors;
        }
        return response()->json($result, $responseCode);
    }

  
    public static function getErrorArray($errorIdArr, $dataArr = array(), $uuid)
    {
        foreach ($errorIdArr as $errorId) {
            $error = array(ResponseKey::CODE => $errorId, ResponseKey::MESSAGE => __(Error::MSG[$errorId]));
            if (array_key_exists($errorId, $dataArr)) {
                $error[ResponseKey::DATA] = $dataArr[$errorId];
            }
            $errorArr[] = $error;
        }
        return $errorArr;
    }

    public static function filterByKey($key, $value, $output)
    {
        return $output = $output->filter(function ($record) use($key, $value) {
            return $record[$key] == $value;
        });
    }
    public static function paginate($collection, $perPage, $page, $total = null,  $pageName = 'page')
    {
        $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
      
        return new LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $total ?: $collection->count(),
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }
}

