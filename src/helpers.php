<?php

use Symfony\Component\Process\Process;

if (! function_exists('create_hooks_dir')) {
    /**
     * Create hook directory if not exists.
     *
     * @param  string  $dir
     * @param  int  $mode
     * @param  bool  $recursive
     *
     * @return void
     */
    function create_hooks_dir($dir, $mode = 0700, $recursive = true)
    {
        if (! is_dir("{$dir}/hooks")) {
            mkdir("{$dir}/hooks", $mode, $recursive);
        }
    }
}

if (! function_exists('is_windows')) {
    /**
     * Determine whether the current environment is Windows based.
     *
     * @return bool
     */
    function is_windows()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }
}
