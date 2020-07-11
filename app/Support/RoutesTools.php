<?php
namespace App\Support;


/**
 * @Class RoutesTools
 * @package App\Support\Tools
 * Contains some usefull methods for Routes inclusions
 */
class RoutesTools
{

    /**
     * Permits to include some routes files using the parameters
     *
     * @param String $dir The path or the dir to the routes directory or the route file to include
     * @param Boolean $recursive : if true try to read the sub directories and try to include routes files.
     * @param string $force_dir : if set, base_path is $force_dir
     * @return void
     */
    public function includeRoutes($dir = null, $recursive = false, $force_dir = null)
    {

        if ($force_dir)
        {
            $path = $force_dir;
        } else
        {
            $path = base_path('routes');
        }

        $path .= ($dir ? '/' . $dir : '');

        if (is_dir($path) && $handle = opendir($path))
        {
            $filepath = $path . '/';

            if ($recursive)
            {
                $filepath .= '**/';
            }

            $files = glob($filepath . '*.routes.php');

            foreach ($files as $file)
            {
                include_once($file);
            }
        }
    }
}
