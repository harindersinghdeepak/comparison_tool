<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Backgrounds
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <span class="btn btn-default fileinput-button">
                    <span>Add Background</span>
                    <input type="file" name="backgound" id="imageUpload-0" multiple>
                </span>
            </div>
            <br/><br/>
            <div class="col-lg-12">
                <ul class="nav" id="imageHolder">
                    <?php
                    $bindImage = array();
                    if($data)
                    {
                        foreach ($data as $key => $value)
                        {
                            $bindKey = ++$key;
                            ?>
                            <li class="col-lg-3" id="image-container-<?= $value['id'] ?>">
                                <div>
                                    <img src="<?= $value['image_path'] ?>">
                                </div>
                                <div class="text-center">
                                    <span class="fileinput-button">
                                        <span>Change</span>
                                        <input type="file" name="backgound" id="imageUpload-<?= $value['id']?>">
                                    </span>
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0)" data-delete-id="<?= $value['id']?>" class="deleteImage">Delete</a>
                                </div>
                            </li>
                            <?php
                            $bindImage[] = array('key' => $bindKey, 'id' => $value['id']);
                        }
                    }
                    $bindImage = json_encode($bindImage);
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>
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
</style>
<script type="text/javascript">
    var bindData = <?= $bindImage ?>;

    
</script>
<script src="<?= ASSETSPATH ?>js/backend/background.js"></script>