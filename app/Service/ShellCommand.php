<?php

namespace App\Service;

use Symfony\Component\Process\Process;

class ShellCommand
{
    public static function execute($cmd): string
    {
        $process = Process::fromShellCommandline($cmd);

        $processOutput = '';

        $captureOutput = function ($type, $line) use (&$processOutput) {
            $processOutput .= $line;
        };

        $process->setTimeout(null)
            ->run($captureOutput);

        if ($process->getExitCode()) {
            $exception = new ShellCommandFailedException($cmd . " - " . $processOutput);
            report($exception);

            throw $exception;
        }

        return $processOutput;
    }
}
