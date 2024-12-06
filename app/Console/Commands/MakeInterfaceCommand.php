<?php

// app/Console/Commands/MakeInterfaceCommand.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeInterfaceCommand extends Command
{
    protected $signature = 'make:rinterface {name}';
    protected $description = 'Create a new interface in the App/Repositories folder';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        $name = $this->argument('name');

        $interfacePath = app_path('Repositories/' . $name . '.php');

        if ($this->files->exists($interfacePath)) {
            $this->error('Interface already exists!');
            return;
        }

        $this->files->put($interfacePath, $this->getStub($name));

        $this->info('Interface created successfully.');
    }

    protected function getStub($name)
    {
        return <<<EOT
<?php

namespace App\Repositories;

interface {$name}
{
    // Define your methods here
}

EOT;
    }
}
