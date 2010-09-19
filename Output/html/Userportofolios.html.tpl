<h3>Our OSIDays Portfolio Management</h3>
<table>
    <thead>
        <th>Name</th>
        <th>Meta</th>
    </thead>
    <tbody>
    
        <?php foreach ($data as $key => $items): ?>

            <td><?php echo $items['name']; ?></td>
            <?php if (isset($items['meta'])) :?>
            <td>
                <ul>
                <?php foreach ($items['meta'] as $met => $meta): ?>

                    <li>
                        <?php echo $meta['meta']['price']; ?>
                    </li>
                    <li>
                        <?php echo $meta['meta']['fluctuation']; ?>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            </td>

        <?php endforeach;  ?>
    </tbody>
</table>