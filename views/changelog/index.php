<?php
    // Reorder history
    $tmp = array();
    foreach ($history as $commit)
    {
        $date = strftime('%B %e, %Y', $commit->author->time);
        empty($tmp[$date]) && $tmp[$date] = array();
        
        $tmp[$date][] = $commit;
    }
    $history = $tmp;
?>
<h1>Recent activity</h1>
<ol>
    <?php foreach ($history as $date => $commits): ?> 
    <li><h2><?php echo $date ?></h2>
        <ol>
        <?php foreach ($commits as $commit): ?> 
            <li>
            <?php echo html::anchor(url::site('/changelog/' . sha1_hex($commit->getName())), 
                                    html::chars($commit->summary)) ?> 
            </li>
        <?php endforeach; ?>
        </ol>
    <?php endforeach; ?>
</ol>