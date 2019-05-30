<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'composer_sandbox');

// Project repository
set('repository', 'https://syntaxseed@github.com/syntaxseed/composersandbox.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', ['config/security.php']);
set('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);
set('allow_anonymous_stats', false);

// How many releases to keep.
set('keep_releases', 3);

// Hosts

host('sherriwcom')
    ->stage('staging')
    ->set('composer_options', 'install --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader --ignore-platform-reqs')
    ->set('bin/composer', '~/private/utils/composer.phar')
    ->set('branch', 'master')
    ->set('deploy_path', '~/www/staging/composersandbox'); // No trailing slash!


// Tasks
desc('Deploy your project');
task('deploy', [
    'deploy:info',          // Figures out which branch of the repo and which host we are using and outputs it. Parses any tag or revision flags passed to the command.
    'deploy:prepare',       // Checks for bash or sh compliant shell. Creates directories needed.
    'deploy:lock',          // Checks if deployment for this stage is 'locked', aborts if so.
    'deploy:release',       // Determine next release number/path. Delete unkept releases. Log releases in .dep/releases.
    'deploy:update_code',   // Git clone and checkout correct release.
    'deploy:shared',        // Symlink shared files and directories. Copies file to be shared from source if not already there.
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
