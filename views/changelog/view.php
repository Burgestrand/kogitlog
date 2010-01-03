<?php
    printf('<h2>%s</h2>', html::chars($commit->summary));
    
    if ( ! empty($commit->detail))
    {
        echo $htmlpurifier->purify(Markdown($commit->detail));
    }
    else
    {
        echo '<p>No extended commit message available.</p>';
    }
    
/* End of file view.php */
/* Location: ./modules/changelog/views/changelog/view.php */ 