<?php
class TestController extends BaseController
{
    public function get()
    {
        if ($this->authenticate()) {
            parent::sendResponse([
                'success' => true,
            ]);
        }
    }

    public function post()
    {
        if ($this->authenticate()) {
            parent::sendResponse([
                'success' => true,
                'data' => $this->request->getJsonRawBody(),
            ]);
        }
   }
}
