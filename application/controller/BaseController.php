<?php
class BaseController extends Phalcon\Mvc\Controller
{
    /**
     * @return bool
     */
    protected function authenticate()
    {
        $app = App::findFirst([
            'conditions' => 'key = ?1',
            'bind' => [
                1 => $this->request->getHeader('X-Public'),
            ]
        ]);

        if ($app) {
            $hash = hash_hmac('sha256', $this->request->getRawBody(), $app->getSecret());

            if ($hash === $this->request->getHeader('X-Hash')){
                return true;
            }
        }

        $this->sendResponse(
            [
                'errors' => [
                    [
                        'message' => 'Unauthorized! Authentication credentials were missing or incorrect.',
                    ]
                ]
            ],
            401
        );
        return false;
    }

    /**
     * @param array $data
     * @param int   $code
     */
    protected static function sendResponse(array $data, int $code = 200)
    {
        $response = new Phalcon\Http\Response();
        $response->setStatusCode($code);
        $response->setJsonContent($data);
        $response->send();
    }
}
