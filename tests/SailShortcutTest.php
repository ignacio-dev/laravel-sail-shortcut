<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\File;

class SailShortcutTest extends TestCase
{
    /**
     * The file name of the backup for the shortcut.
     */
    public string $backupFileName = 'ignacio-dev__laravel-sail-shortcut__backup';

    /**
     * Is the shortcut already installed?
     */
    public bool $fileAlreadyExists;

    /**
     * Has the pre-existing shortcut been backed up?
     */
    public bool $preExistingFileWasBackedUp = false;

    /**
     * The file name of the shortcut.
     */
    public string $targetFileName = 'sail';

    /**
     * The target file path where the shortcut should get installed.
     */
    public string $targetFilePath;

    /**
     * Setup the test.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->targetFilePath = base_path($this->targetFileName);

        $this->fileAlreadyExists = File::exists($this->targetFilePath);

        if ($this->fileAlreadyExists) {
            $this->createExistingFileBackup();
        }
    }

    /**
     * Tear down the test.
     */
    public function tearDown(): void
    {
        if ($this->preExistingFileWasBackedUp) {
            if (File::exists($this->targetFilePath)) {
                File::delete($this->targetFilePath);
            }

            $this->restorePreExistingFileFromBackup();
        }

        parent::tearDown();
    }

    /**
     * Test that the shortcut can be installed.
     */
    public function test_installs_shortcut(): void
    {
        $this->artisan('sail-shortcut:install')
            ->assertExitCode(0);
        
        $this->assertFileExists($this->targetFilePath);
        
        $this->assertTrue(is_executable($this->targetFilePath));
    }

    /**
     * Test that the shortcut can be uninstalled.
     */
    public function test_uninstalls_shortcut(): void
    {
        $this->artisan('sail-shortcut:install');

        $this->artisan('sail-shortcut:uninstall')
            ->assertExitCode(0);
        
        $this->assertFileDoesNotExist($this->targetFilePath);
    }

    /**
     * Backup an existing file, to avoid overwriting it while testing.
     */
    protected function createExistingFileBackup(): bool
    {
        $this->preExistingFileWasBackedUp = File::move($this->targetFileName, $this->backupFileName);
        return $this->preExistingFileWasBackedUp;
    }

    /**
     * Backup an existing file, to avoid overwriting it while testing.
     */
    protected function restorePreExistingFileFromBackup(): bool
    {
        return File::move($this->backupFileName, $this->targetFileName);
    }
}
