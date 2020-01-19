<?php

namespace MyApp\Log;

use DateTime;
use MyApp\Common\Xml;

class Logger
{
    //設定ファイルパス
    private const CONF_FILE_PATH = "config".DIRECTORY_SEPARATOR."Log.xml";

    //ログレベル
    private const LOG_LEVEL_DEBUG = "DEBUG";
    private const LOG_LEVEL_INFO = "INFO";
    private const LOG_LEVEL_WARN = "WARN";
    private const LOG_LEVEL_ERROR = "ERROR";
    private const LOG_LEVEL = array(self::LOG_LEVEL_DEBUG, 
                                    self::LOG_LEVEL_INFO,
                                    self::LOG_LEVEL_WARN,
                                    self::LOG_LEVEL_ERROR);

    //ログ出力有無
    private const ON = true;
    private const OFF = false;

    //ログ設定
    static private $outputFlg = false;  //出力有無
    static private $path = "";          //フォルダパス
    static private $fileName = "";      //ファイル名
    static private $extention = "";     //拡張子
    static private $logLevel = "";      //ログレベル

    //初期化有無
    static private $initFlg = false;

    private function __construct(){
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function Init():void
    {

        //設定ファイルの読み込みを行い、初期化する
        if (self::$initFlg === false){

            if (file_exists(self::CONF_FILE_PATH) === false){
                throw new FileNotExistsException(self::CONF_FILE_PATH);
            }

            $xml = simplexml_load_file(self::CONF_FILE_PATH);
            self::$outputFlg = $xml->OUTPUT;
            self::$path = $xml->PATH;
            self::$fileName = $xml->NAME;
            self::$extention = $xml->EXTENTION;
            self::$logLevel = strtoupper($xml->LEVEL);

            if (array_search(self::$logLevel, self::LOG_LEVEL) === false){
                throw new ErrorException($self::CONF_FILE_PATH."の設定値が不正です");
            }

            self::$initFlg = true;
        }
    }

    /**
     * デバッグログを出力する。
     *
     * @param String $value
     * @return void
     */
    public static function Debug(String $value):void
    {
        self::Write(self::LOG_LEVEL_DEBUG, $value);
    }

    /**
     * インフォメーションログを出力する。
     *
     * @param String $value
     * @return void
     */
    public static function Information(String $value):void
    {
        self::Write(self::LOG_LEVEL_INFO, $value);
    }

    /**
     * 警告ログを出力する。
     *
     * @param String $value
     * @return void
     */
    public static function Warning(String $value):void
    {
        self::Write(self::LOG_LEVEL_WARN, $value);
    }

    /**
     * エラーログを出力する。
     *
     * @param String $value
     * @return void
     */
    public static function Error(String $value):void
    {
        self::Write(self::LOG_LEVEL_ERROR, $value);
    }

    /**
     * 
     *
     * @param string $value
     */
    private static function Write(String $level, String $value):void
    {

        self::Init();

        $confLevel = array_search(self::$logLevel, self::LOG_LEVEL);
        $outLevel = array_search($level, self::LOG_LEVEL);

        //ログ設定から出力有無を判定
        if (self::$outputFlg === false){
            return;
        }

        if ($confLevel > $outLevel){
            return;
        }

        $nowDate = new DateTime("now");
        $fileName = self::$path.self::$fileName."_".$nowDate->format("Ymd").self::$extention;

        try{

            //ログ出力フォルダが存在しない場合、作成する
            if (file_exists(self::$path) === false){
                if (mkdir(self::$path) === false){
                    return;
                }
            }

            //ログフォーマット"yyyy/MM/dd hh:mi:ss.vvv [xxxxx] 〇〇〇〇"
            file_put_contents($fileName,
                              $nowDate->format("Y/m/d H:i:s.v")." [".str_pad($level, 5, " ", STR_PAD_RIGHT)."] ".$value.PHP_EOL,
                              FILE_APPEND | LOCK_EX);

        }catch(Exception $ex){
            //なにもしない
        }
    }
}