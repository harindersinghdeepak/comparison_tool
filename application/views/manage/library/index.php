<?php
    $categorySelect = '';
    if($category)
    {
        $categorySelect .= '<select class="form-control editTool hide" name="categoryName"><option value="">Choose a category</option>';
        foreach ($category as $key => $value)
        {
            $categorySelect .= '<option value="'. $value['id'].'" >'. $value['category_name'].'</option>';
        }
        $categorySelect .= '</select>';
    }
?>
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
                <span class="btn btn-default fileinput-button btn-flat iBlueBtn ">
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
                    <li><a href="javascript:void(0)" class="btn btn-default btn-flat iBlueBtn saveAll">Save All</a></li>
                </ul>
            </div>
            <br/><br/>
            <div class="col-lg-12" id="image_main_holder">
                <div class="loader">
                    <!-- <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                        <a href="" class="cancelProcess"><i class="fa fa-close"></i></a>
                    </div>
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                        <a href="" class="cancelProcess"><i class="fa fa-close"></i></a>
                    </div> -->
                </div>
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
                    <tbody>
                <?php
                $bindImage = array();
                if($data)
                {
                    $cnt = 1; 
                    foreach ($data as $key => $value)
                    {
                        ?>
                            <tr id="image-container-<?= $cnt ?>">
                                    <td><?= $cnt ?></td>
                                    <td>
                                        <div style="position: relative;text-align: center">
                                            <img src="<?= $value['image_path'] ?>">
                                            <span class="btn btn-default fileinput-button btn-flat iBlueBtn editTool hide image-edit-btn">
                                                <span>Update</span>
                                                <input type="file" name="image" id="imageUpload-<?= $cnt ?>">
                                            </span>
                                        </div>
                                    </td>
                                    <td> 
                                        <span class="renderTool" id="categoryName"><?= $value['category_name'] ?></span>
                                        <select class="form-control editTool hide" name="categoryName">
                                            <option value="">Choose a category</option>
                                            <?php
                                                foreach ($category as $key => $cat)
                                                {
                                                    ?>
                                                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $value['cat_id'] ? 'selected' : '' ?> ><?= $cat['category_name'] ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <span class="renderTool" id="imageName"><?= $value['image_name'] ?></span>
                                        <input type="text" class="form-control editTool hide" name="imageName" value="<?= $value['image_name'] ?>">        
                                    </td>
                                    <td>
                                        <span class="renderTool" id="imageSize"><?= $value['image_size'] ?></span>
                                        <input type="text" class="form-control editTool hide" name="imageSize" value="<?= $value['image_size'] ?>">
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-id="<?= $value['id'] ?>" data-edit-id="<?= $cnt ?>" class="editImage btn btn-default iBlueBtn btn-flat renderTool">Edit</a>
                                        <a href="javascript:void(0)" data-id="<?= $value['id'] ?>" data-save-id="<?= $cnt ?>" class="saveImage btn btn-default iBlueBtn btn-flat editTool hide">Save</a>
                                    </td>
                                    <td><a href="javascript:void(0)" data-id="<?= $value['id'] ?>" data-delete-id="<?= $cnt ?>" class="imageDelete"><i class="fa fa-trash fa-2x"></i></a></td>
                                    </div>
                                </tr>
                        <?php 
                        $bindImage[] = array('key' => $cnt);
                        $cnt++;   
                    }
                }
                else{
                    ?>
                    <!-- <p class="text-center">There is no image</p> -->
                    <?php
                }
                $bindImage = json_encode($bindImage);
                ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<style type="text/css">
    div#image_main_holder table img{
        max-width: 100px;
        max-height: 100px;
        border: 1px solid #d7d7d7;
        padding: 2px;
        box-shadow: 0px 0px 2px 1px #d6d6d6;
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

    .progress{
        width: 20%;
        /*display: inline-block;*/
        position: relative;
        overflow: visible;
    }
    .image-edit-btn {
        position: absolute;
        top: 45%;
        left: 20%;
    }
    a.cancelProcess {
        position: absolute;
        top: -1px;
        right: -12px;
        color: red;
    }
</style>
<?php
    $categorySelect = '';
    if($category)
    {
        $categorySelect .= '<select class="form-control editTool" name="categoryName"><option value="">Choose a category</option>';
        foreach ($category as $key => $value)
        {
            $categorySelect .= '<option value="'. $value['id'].'" >'. $value['category_name'].'</option>';
        }
        $categorySelect .= '</select>';
    }
?>  
<script type="text/javascript">
    var categoryStructure = '<?= $categorySelect ?>';
    
    var bindData = <?= $bindImage ?>;
</script>
 
<script src="<?= ASSETSPATH ?>js/backend/library.js"></script>