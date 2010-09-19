<response>
    <stocks>
        <?php foreach ($data as $key => $items): ?>
        <stock>
            <name><?php echo $items['name']; ?></name>
            <?php if (isset($items['meta'])) :?>
            <meta>
            <?php foreach ($items['meta'] as $met => $meta): ?>
                <price><?php echo $meta['meta']['price']; ?></price>
                <fluctuation><?php echo $meta['meta']['fluctuation']; ?></fluctuation>
            <?php endforeach; endif; ?>
            </meta>
        </stock>
        <?php endforeach;  ?>
    </stocks>
</response>