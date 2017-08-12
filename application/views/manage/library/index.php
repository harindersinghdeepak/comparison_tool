<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Library
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <span class="btn btn-default fileinput-button">
                    <span>Add Picture</span>
                    <input type="file" name="image" id="imageUpload-0" multiple>
                </span>

                <ul class="option">
                    <li>Sort by </li>
                    <li>
                        <select name="sorting" id="" class="form-control">
                            <option value="default" <?= isset($sort) && $sort == 'default' || $sort == '' ? 'selected' : '' ?> >Default</option>
                            <option value="name-asc" <?= isset($sort) && $sort == 'name-asc' ? 'selected' : '' ?> >Name A-Z</option>
                            <option value="category-asc" <?= isset($sort) && $sort == 'category-asc' ? 'selected' : '' ?> >Category A-Z</option>
                        </select>
                    </li>
                    <li><a href="javascript:void(0)" class="btn btn-default saveAll">Save All</a></li>
                </ul>
            </div>
            <br/><br/>
            <div class="col-lg-12" id="image_main_holder">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Image Name</th>
                            <th>Suggest Size</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                <?php
                if($data)
                {
                    $cnt = 1;
                    foreach ($data as $key => $value)
                    {
                        ?>
                            <tr id="image-container-<?= $cnt ?>">
                                    <td><?= $cnt ?></td>
                                    <td><img src="<?= $value['image_path'] ?>"></td>
                                    <td> <?= $value['category_name'] ?></td>
                                    <td><?= $value['image_name'] ?></td>
                                    <td><?= $value['image_size'] ?></td>
                                    <td><a href="javascript:void(0)" data-id="<?= $value['id'] ?>" data-save-id="<?= $cnt ?>" class="editImage btn btn-default">Edit</a></td>
                                    <td><a href="javascript:void(0)" data-id="<?= $value['id'] ?>" data-delete-id="<?= $cnt ?>" class="imageDelete"><i class="fa fa-trash fa-2x"></i></a></td>
                                    </div>
                                </tr>
                        <?php 
                        $cnt++;   
                    }
                }
                else{
                    ?>
                    <tbody><tr><td colspan="7" align="center">There is no image</td></tr></tbody>
                    <?php
                }
                ?>
                </table>
            </div>
        </div>

    </div>
</div>
<?php
    $categorySelect = '';
    if($category)
    {
        $categorySelect .= '<select class="form-control" name="categoryName"><option value="">Choose a category</option>';
        foreach ($category as $key => $value)
        {
            $categorySelect .= '<option value="'. $value['id'].'" >'. $value['category_name'].'</option>';
        }
        $categorySelect .= '</select>';
    }
?>
<style type="text/css">
    img{
        width: auto;
        height: 200px;
    }
    ul#imageHolder li{
        float: none !important;
        display: inline-block !important;
        margin-left: -4px;
        vertical-align: top;
        margin-bottom: 10px;
    }
    ul.option{
        list-style: none;
        padding: 5px;
        display: inline-block;
        float: right;
    }
    ul.option li{
        display: inline-block;
    }
</style>
<script type="text/javascript">
    var categoryStructure = '<?= $categorySelect ?>';
</script>
<script src="<?= ASSETSPATH ?>js/backend/library.js"></script>