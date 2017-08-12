    <div id="page-wrapper" class="page-wrapper">
        <div class="col-lg-12 add-new-wrapper">
            <button class="btn btn-flat btn-default iAddBtn iBlueBtn" data-toggle="modal" data-target="#add_category_modal">Add Category</button>
        </div>
        
        <div class="col-lg-12">
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
                                <td style="text-align: center;">
                                    <span><?php echo $keyC+1; ?></span>
                                </td>
                                <td class="cat_nm_td">
                                    <span><?php echo $valueC['category_name']; ?></span>
                                    <input type='text' class='form-control cat_nm_txt hide' value='<?php echo $valueC['category_name']; ?>'>
                                </td>
                                <td style="text-align: center;">
                                    <a title="Edit" href="javascript:void(0);" onclick="edit_cat_toggle(this);" class="btn btn-flat btn-default iEditBtn iBlueBtn">Edit</a>
                                    <button class="save_btn hide btn btn-flat btn-default iEditBtn" onclick="edit_category(this, '<?php echo $valueC['id']?>')">Save</button>
                                </td>
                                <td style="text-align: center;">
                                    <a title="Delete" href="javascript:void(0);" onclick="delete_category(this, '<?php echo $valueC['id']?>');"><i class="fa fa-trash iTrashIcon"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                            <script type="text/javascript">
                                $(document).ready(function()
                                {
                                    $('#categories_table').DataTable({
                                        responsive: true
                                    });
                                });
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
    </div>
</div>

<div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="head_wrapper">
                <span>Add Category</span>
            </div>
            <div class="input_wrapper">
                <form id="add_category_form">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                    <input type="text" name="category_name[]" class="form-control">
                </form>
            </div>
            <div class="foot_btn_wrapper text-center">
                <button class="btn btn-flat btn-default iSaveBtn iBlueBtn" onclick="save_categories(this);">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= ASSETSPATH ?>js/backend/category.js"></script>