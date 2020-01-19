<?php

namespace MyApp\Common\Exception;

/**
 * Undocumented class
 */
class FileNotExistsException extends Exception
{

    /**
     * Undocumented function
     *
     * @param string $filePath
     * @param integer $code
     * @param Exception $previous
     */
    public function __construct(string $filePath, $code = 0, Exception $previous = null) {
        $message = "[".$filePath."]がありません";

        parent::__construct($message, $code, $previous);
    }

}
