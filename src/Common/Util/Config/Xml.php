<?php

namespace MyApp\Common;

use MyApp\Common\Exception\FileNotExistsException;

class Xml
{

    private $filePath = "";

    /**
     * Undocumented function
     *
     * @param string $filePath
     */
    public function __construct(string $filePath){

        if (file_exists($this->filePath) === false){
            throw new FileNotExistsException($this->filePath);
        }

        $this->filePath = $filePath;
    }

    /**
     * Undocumented function
     *
     * @param string $content
     * @return string
     */
    public function Read(string $content):string{

        $value = "";

        $xml = simplexml_load_file($this->filePath);

        if ($count = count($xml->item) != 1){
            return $value;
        }

        $valuse = $xml->{"$content"};
    }

    /**
     * Undocumented function
     *
     * @param string $content
     * @param string $value
     * @return boolean
     */
    public function Update(string $content, string $value):bool{

    }
    
}