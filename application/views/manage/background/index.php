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
                <span class="btn btn-default fileinput-button btn-flat iBlueBtn">
                    <span>Add Background</span>
                    <input type="file" name="backgound" id="imageUpload-0" multiple>
                </span>
            </div>
            <br/><br/>
            <div class="loader">
                <!-- <div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                    <a href="" class="cancelProcess"><i class="fa fa-close"></i></a>
                </div> -->
            </div>
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
                            <li class="" id="image-container-<?= $value['id'] ?>">
                                <div class="text-center">
                                    <img src="<?= $value['image_path'] ?>">
                                </div>
                                <div class="text-center">
                                    <span class="fileinput-button upload-image-button">
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
    ul#imageHolder li img{
        max-width: 150px;
        max-height: 150px;
        border: 1px solid #d7d7d7;
        padding: 2px;
        box-shadow: 0px 0px 2px 1px #d6d6d6;
    }
    span.upload-image-button{
        display: inline-flex !important;
        color: #337ab7;
    }
    ul#imageHolder li{
        float: none !important;
        display: inline-block !important;
        /*margin-left: -4px;*/
        vertical-align: top;
        margin: 10px;
        max-width: 170px;
        max-height: 170px;
    }
    .progress{
        width: 20%;
        /*display: inline-block;*/
        position: relative;
        overflow: visible;
    }
    a.cancelProcess {
        position: absolute;
        top: -1px;
        right: -12px;
        color: red;
    }
</style>
<script type="text/javascript">
    var bindData = <?= $bindImage ?>;

    
</script>
<script src="<?= ASSETSPATH ?>js/backend/background.js"></script>