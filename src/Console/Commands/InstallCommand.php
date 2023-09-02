<?php

namespace IgnacioDev\SailShortcut\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sail-shortcut:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Laravel Sail terminal shortcut.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->title('Laravel Sail Shortcut');
        
        $this->line('Instaling...');

        $stub_path = __DIR__.'/../../../stubs/sail';

        $target_path = base_path('sail');

        if (file_exists($target_path)) {
            $this->output->error('There is already a file on the root of your project called "sail".');        
            $this->output->warning('The shortcut was not installed.');
            $this->output->warning('Your original file was not replaced.');
            return Command::FAILURE;
        }

        if (!copy($stub_path, $target_path)) {
            $this->output->error('Failed to copy the file.');
            $this->output->warning('The shortcut was not installed.');
            return Command::FAILURE;
        }

        // Set executable permissions on the copied file
        if (!chmod($target_path, 0755)) {
            $this->output->error('Failed to set executable permissions.');
            $this->output->warning('The shortcut was installed but cannot be executed.');
            return Command::FAILURE;
        }

        $this->output->newLine(1);
        $this->output->writeln("<fg=green;options=bold>SUCCESS!</>");
        $this->info('The shortcut has been installed :)');
        $this->output->writeln('<fg=blue>QUICK NOTE:</> Make sure to add <fg=gray>/sail</> to your <fg=gray>.gitignore</> file.');
        $this->output->newLine(1);
        return Command::SUCCESS;
    }
}
