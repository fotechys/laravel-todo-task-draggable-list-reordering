<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (\Throwable $e) {
            /*Log::channel('slack')->error($e->getMessage(),[
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
            ]);*/

            // Log::channel('slack')->error($e->getMessage(),$e->getTrace());
            $error_Log = collect([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),

            ])->concat($e->getTrace())->toArray();
            Log::channel('slack')->error($e->getMessage(),$error_Log);

        });
    }
}
