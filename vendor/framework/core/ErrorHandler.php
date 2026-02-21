<?php

namespace framework\core;

//define ("DEBUG", 1);
// 1 - for dev
// 0 - for prod

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
           
            //  show all mistakes
            error_reporting(-1);
        } else {
            // not show
            error_reporting(0);
        }

        
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
       
    }

    public function errorHandler(
        $errno, $errstr, $errfile, $errline)
    {
        
        //var_dump($errno, $errstr, $errfile, $errline);
        //error_log("irina", 3, __DIR__ . "/errors.log");
        /* error_log(
            "[" . date('Y-m-d H:i:s') . "] 
        Текст ошибки: {$errstr} |
        Файл: {$errfile} |
        Строка: {$errline}
        \n======\n", 3, 
        __DIR__ . '/errors.log'); */
        
        $this->logErrors(
            $errstr, $errfile, $errline
        );
        
        //error_log("Ops", 3, __DIR__.'/errors.log');

        if (DEBUG || 
            in_array($errno, [E_USER_ERROR, 
                E_RECOVERABLE_ERROR]) ) {
        $this->displayError($errno, $errstr, $errfile, $errline);
        } 
        return true;
    }

    public function fatalErrorHandler()
    {
        //echo "irina";
        $error = error_get_last();
        
        if ( !empty($error) && $error['type'] 
        & (E_ERROR | E_PARSE | E_COMPILE_ERROR | 
        E_CORE_ERROR) ) {
            //var_dump($error['message']);
            /* error_log(
                "[" . date('Y-m-d H:i:s') . "] 
            Текст ошибки: {$error['message']} |
            Файл: {$error['file']} |
            Строка: {$error['line']}
            \n======\n", 3, 
            __DIR__ . '/errors.log'); */
            $this->logErrors(
                $error['message'], 
                $error['file'], 
                $error['line']
            );
            ob_end_clean();
            $this->displayError(
                $error['type'], $error['message'], 
                $error['file'], $error['line']
            );
        } else {
            ob_end_flush();
        }
    }


    public function exceptionHandler($ex)
    {
        //var_dump($ex);
        // 'Oh' - Code of mistake
        /* error_log(
            "[" . date('Y-m-d H:i:s') . "] 
        Текст ошибки: {$ex->getMessage()} |
        Файл: {$ex->getFile()} |
        Строка: {$ex->getLine()}
        \n======\n", 3, 
        __DIR__ . '/errors.log'); */
        $this->logErrors(
            $ex->getMessage(),
            $ex->getFile(),
            $ex->getLine()
        );
        $this->displayError('Oh', 
        $ex->getMessage(), $ex->getFile(), 
        $ex->getLine(), $ex->getCode());
    }


    protected function logErrors(
        $message = ' ',
        $file = ' ',
        $line = ' ' )
    { 
        error_log(
            "[" . date('Y-m-d H:i:s') . "] 
        Текст ошибки: {$message} |
        Файл: {$file} |
        Строка: {$line}
        \n======\n", 3, 
        ROOT . '/tmp/errors.log');
    }


    protected function displayError(
        $errno, $errstr, $errfile, $errline, 
        $response = 500)
    {

        http_response_code($response);
        if ($response == 404 && !DEBUG) {
            require WWW . '/errors/404.html';
            die;
        }

        if (DEBUG) {
            require WWW . '/errors/dev.php';
        } else {
            require WWW . '/errors/prod.php';
        }
        die;
    }
   
}

new ErrorHandler();
//$test = "irina";
//echo $test33; // error

//test();  // FATAL error

/* try{
    if (empty($test)){
        throw new Exception('Ooops');
    }
} catch (Exception $e) {
    var_dump($e);
}; */

// 'Ooops' - Text of mistake
//throw new Exception('Ooops', 404);


/* class NotFoundException extends Exception
{
    public function __construct(
        $message = ' ', $code = 404
    )
    {
        parent::__construct($message, $code);
    }
}
 */


