<?php
class ErrorController extends BaseController
{
    /**
     * @param Exception $e
     */
    public static function error(Exception $e)
    {
        parent::sendResponse(
            [
                'errors' => [
                    [
                        'message' => $e->getMessage() ?: 'Sorry, something went wrong.',
                        'code' => $e->getCode(),
                    ]
                ]
            ],
            500
        );
    }

    public static function notFound()
    {
        parent::sendResponse(
            [
                'errors' => [
                    [
                        'message' => 'Sorry, that page does not exist.',
                    ]
                ]
            ],
            404
        );
    }
}
