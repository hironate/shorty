<table id="<?php echo e($table_id); ?>" class="table table-hover">
    <thead>
        <tr>
            <th>Link Ending</th>
            <th>Long Link</th>
            <th>Clicks</th>
            <th>Date</th>
            <?php if($table_id == "admin_links_table"): ?>
            
            <th>Creator</th>
            <th>Disable</th>
            <th>Delete</th>
            <?php endif; ?>
        </tr>
    </thead>
</table>
