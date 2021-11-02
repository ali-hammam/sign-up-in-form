<?php


trait makeCommands
{

    public function makeModel($modelName)
    {
        $this->create('Model', $modelName, 'modelFormat');
    }

    public function makeMigration($migrationName)
    {
        $this->create('Database/migrations', $migrationName, 'migrationFormat');
    }

    public function makeController($controllerName)
    {
        $this->create('Controller', $controllerName, 'controllerFormat');
    }

    public function makeMigrate($controllerName)
    {
        require_once ROOT . '/Database/migrations/' . $controllerName . '.php';
        $migrationName = $controllerName;
        $path = '\Database\migrations\\';
        $classPath = $path . $migrationName;
        $migrationObj = new $classPath();
        $migrationObj->run('create');
    }

    public function create($dir, $filename, $txtFile)
    {
        if (is_writable($dir . "/" . $filename . ".php")) {
            echo 'file already exists';
        } else {
            $file = fopen($dir . "/" . $filename . ".php", "w");
            $arr = @file(__DIR__ . '/' . $txtFile . '.txt');
            if (is_array($arr)) {
                foreach ($arr as $line) {
                    $arr = explode(' ', $line);
                    if (array_search('test', $arr, true)) {
                        $x = array_search('test', $arr, true);
                        $arr[$x] = $filename;
                    }
                    $line = implode(' ', $arr);
                    fwrite($file, $line);
                }
            }
        }
    }
}
