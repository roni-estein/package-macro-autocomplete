<?php

namespace PackageMacroAutocomplete\Console\Commands;

use Illuminate\Console\Command;

/**
 * A command to generate autocomplete information for your IDE
 */
class AutoCompleteCommand extends Command
{
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'autocomplete:generate {name=_package_macro_ide_helper}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Autocomplete for Macros in Vendor.';
    
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $combined = '';
        foreach(glob(base_path('vendor').'/**/**/AutoCompletionHelper.php') as $filename){
            $combined .=file_get_contents($filename);
        }
        
        
        $this->file_force_contents(base_path($this->argument('name').'.php'),
            "<?php\n".str_ireplace(["<?php\n","<?php", "?>\n","?>"],"",$combined)
        );
        
        $this->info('Generating ...');
        $this->info($this->argument('name').'.php ........ OK');

    }
    
    private function file_force_contents($dir, $contents){
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        foreach($parts as $part)
            if(!is_dir($dir .= "/$part")) mkdir($dir);
        file_put_contents("$dir/$file", $contents);
    }
}
