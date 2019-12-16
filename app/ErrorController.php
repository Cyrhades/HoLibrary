<?php

namespace HO;

class ErrorController extends Controller
{
    public function exception($message)
    {
        $this->_view = 'errors/exception';
        $this->render(['message' => $message]);
    }

    public function error404()
    {
        $this->_view = 'errors/error_404';
        $this->render();
    }

    public function error405()
    {
        $this->_view = 'errors/error_405';
        $this->render();
    }
}