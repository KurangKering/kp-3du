<?php
class Response {
    public $success = true, $code, $msg, $data, $error = [];

    public function addError($text, $field = null) {
        $this->success = false;

        $obj = new \stdClass();
        $obj->field = $field;
        $obj->msg = $text;
        $this->error[] = $obj;
    }

    public function addData($obj) {
        return $this->data[] = $obj;
    }

    public function getTotalData() {
        return count($this->data);
    }

    public function getError() {
        return $this->error;
    }

    public function getLengthError() {
        return count($this->error);
    }

    public function isError() {
        return count($this->error) > 0 && !$this->success;
    }

    public function isSuccess() {
        return count($this->error) == 0 && $this->success;
    }

    public function setMessage($txt) {
        return $this->msg = $txt;
    }

    public function getMessage() {
        return $this->msg;
    }

    public function setCode($v) {
        return $this->code = $v;
    }

    public function getCode() {
        return $this->code;
    }

}
