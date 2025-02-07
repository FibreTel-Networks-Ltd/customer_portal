<?php
namespace Deployer;

require 'recipe/laravel.php';

localhost();
set('repository', 'https://github.com/FibreTel-Networks-Ltd/customer_portal.git');
set('branch', 'master');
set('keep_releases', 3);
set('deploy_path', '/opt/customer_portal');
set('update_code_strategy', 'clone');

task('composer:post-update-cmd', function () {
    run('cd {{release_path}} && composer run-script post-update-cmd');
});


task('deploy', [
    'deploy:check_remote',
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:view:cache',
    'artisan:event:cache',
    'artisan:migrate',
    'composer:post-update-cmd',
    'deploy:publish',
]);
