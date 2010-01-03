<?php defined('SYSPATH') OR die('No direct access allowed.');
    
    // Allows commit view
    Route::set('changelog/commit', 
               'changelog/<commit>',
               array(
                   'commit' => '(?i)[0-9a-f]{40}',
               ))->defaults(array(
                                'controller' => 'changelog',
                                'action' => 'view',
                            ));

/* End of file init.php */
/* Location: ./modules/changelog/init.php */ 