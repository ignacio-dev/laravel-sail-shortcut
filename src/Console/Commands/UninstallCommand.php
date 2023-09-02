<?php

namespace IgnacioDev\SailShortcut\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UninstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sail-shortcut:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall Laravel Sail terminal shortcut.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->title('Laravel Sail Shortcut');
        
        $this->line('Uninstalling...');

        $path = base_path('sail');

        if (!File::exists($path)) {
            $this->output->error('Sil shortcut not found.');        
            $this->output->warning('The Sail shortcut could not be removed because it could not been found. Are you sure it was installed?');
            return Command::FAILURE;
        }

        if (!File::delete($path)) {
            $this->output->error('An unknown error occurred while removing the shortcut.');
            return Command::FAILURE;
        }

        $this->output->newLine(1);
        $this->output->writeln("<fg=green;options=bold>SUCCESS!</>");
        $this->info('The shortcut has been uninstalled :)');
        $this->output->writeln('<fg=blue>QUICK NOTE:</> You may also want to remove the library from composer.');
        $this->output->newLine(1);
        
        return Command::SUCCESS;
    }
}
