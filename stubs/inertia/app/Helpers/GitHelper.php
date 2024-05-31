<?php

namespace App\Helpers;

class GitHelper
{
    public static function getVersion()
    {
        $path = base_path();
        $command = 'git describe --always --tags --dirty';
        $dir = getcwd();
        chdir($path);
        $output = shell_exec($command);
        chdir($dir);
        $fail = $output === null;
        if($fail){
            return '';
        }
        $version = explode("-",$output);
        return $version[0];
    }
}
