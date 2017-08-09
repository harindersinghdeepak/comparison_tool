<div id="page-wrapper">
    <table id="categories_table" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="text-align: center;">No.</th>
                <th>Category</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (sizeof($categories) > 0)
            {
                foreach ($categories as $keyC => $valueC)
                {
                ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $keyC+1; ?></td>
                        <td><?php echo $valueC['category_name']; ?></td>
                        <td style="text-align: center;"><a title="Edit" href="category/edit/<?php echo $valueC['id']; ?>" class="btn btn-flat btn-default iEditBtn">Edit</a></td>
                        <td style="text-align: center;"><a title="Delete" href="category/delete/<?php echo $valueC['id']; ?>"><i class="fa fa-trash iTrashIcon"></i></a></td>
                    </tr>
                <?php
                }
                ?>
                    <script type="text/javascript">
                        $('#categories_table').DataTable();
                    </script>
            <?php
            }
            else
            {
            ?>
                <tr><td style="text-align: center;" colspan="4">No record found.</td></tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>