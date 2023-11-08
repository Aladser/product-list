<?php

namespace App\Http\Middleware;

use App\ScriptLinuxProcess;
use Illuminate\Http\Request;

/** класс запуска вебсокета */
class IsActiveQueue
{
    // проверяет активность вебсокета
    public function handle(Request $request, \Closure $next)
    {
        $os = explode(' ', php_uname())[0];
        if ($os !== 'Windows') {
            $queue = new ScriptLinuxProcess(
                'laravel-queue',
                dirname(__DIR__, 2).'/laravel-queue.php',
                dirname(__DIR__, 3).'/storage/logs/queue.log',
                dirname(__DIR__, 3).'/storage/logs/pids.log'
            );
            if (!$queue->isActive()) {
                $queue->run();
            }
        }

        return $next($request);
    }
}
