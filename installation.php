<?php

/**
 * Created by PhpStorm.
 * User: Kushchenko Valentin
 * Company: PRO-STOR.NET
 * Date: 18.06.2017
 * Time: 20:05
 */
class Installation
{
    private $step;
    private $error;

    /**
     * Install constructor.
     */
    public function __construct()
    {
        $this->collectPostData();
        $this->installStepByStep();
    }

    private function collectPostData()
    {
        try {
            if (isset($_POST["step"])) {
                $this->step = $_POST["step"];
            } else {
                throw new Exception("Запрос сформирован не верно", 410);
            }
        } catch (Exception $e) {
            $this->error = [
                'error' => [
                    'msg' => $e->getMessage(),
                    'code' => $e->getCode(),
                ],
            ];
            $this->sendErrorResponse();
            exit();
        }
    }

    private function sendErrorResponse()
    {
        header('Content-Type: application/json');
        echo json_encode($this->error);
    }

    private function installStepByStep()
    {
        header('Content-Type: application/json');
        echo json_encode(
            ["step" => $this->step]
        );
    }
}

new Installation();