<script type="text/javascript">
    var categories_and_images = '<?php print_r(json_encode($categories_and_images))?>';
</script>

<div class="col-lg-12">
    <div class="col-lg-2" style="background-color: #383A3C; color: whitesmoke; padding: 15px;">
        <span>OVERLAY MEDIA BUTTONS</span>
        <hr style="border-top: 1px dotted grey">
        <button class="btn btn_flat" style="background-color: #47BA27">Upload</button>
        <button class="btn btn-default btn_flat" onclick="toggleGalleryDiv();">Gallery</button>
    </div>

    <div class="col-lg-9">
        <img src="/assets/images/landscape.jpg" alt="image" style="width: 98%;">
    </div>
</div>

<div class="col-lg-8 hide categories_div">
    <div class="col-lg-12 iCatSearchDiv">
        <input type="text" placeholder="Search image" name="search_cat_image" id="search_cat_image" class="form-control" onkeyup="search_cat_image();">
    </div>
    <div class="col-lg-9 iCatImagesDiv"></div>
    <div class="col-lg-3 iCatsDiv"></div>
</div>

<style type="text/css">
    body{
        background-color: #262424;
    }
    .btn_flat{
        border-radius: 0px !important;
    }
    .categories_div{
        position: absolute;
        left: 240px;
        background-color: #4D4D4D;
        top: 126px;
    }
    .cats_ul{
        margin: 0px;
        background-color: #383A3C;
    }
    .cats_ul li{
        list-style: none;
        padding: 10px;
        border-bottom: 1px solid grey;
    }
    .cats_ul li:hover{
        background-color: #47BA27;
    }
    .cats_ul a{
        color: white;
    }
    .iCatImages{
        background-color: white;
        padding: 3px;
        max-width: 100px;
        max-height: 100px;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .iCatSearchDiv{
        margin: 10px 0px;
    }
    .iActive{
        background-color: #47BA27;
    }
</style>

<script type="text/javascript">
    function toggleGalleryDiv()
    {
        $('.categories_div').toggleClass('hide');
    }

    $(document).ready(function(){
        render_cat_div();
    });

    function render_cat_div()
    {
        var cat_images = JSON.parse(categories_and_images);

        var cats_html = '<ul class="cats_ul">';
        for (var i = 0; i < cat_images.length; i++)
        {
            if (cat_images[i]['category_images'].length > 0)
            {
                var li_cls = 'iCatLi_' + i;
                if (i == 0)
                {
                    li_cls += ' iActive';
                }
                cats_html += '<li class="'+ li_cls +'"><a href="javascript:void(0);" onclick="toggleCatImages('+ i +');">'+ cat_images[i]['category_name'] +'</a></li>';
            }
        }
        cats_html += '</ul>';

        $('.iCatsDiv').html(cats_html);

        toggleCatImages(0);
    }

    function toggleCatImages(index)
    {
        $("li.iActive").removeClass('iActive');
        $("li.iCatLi_" + index).addClass('iActive');

        var cat_images = JSON.parse(categories_and_images);

        var images_html = '';
        for (var i = 0; i < cat_images[index]['category_images'].length; i++)
        {
            images_html += '<a href="javascript:void(0);"><img class="iCatImages" src="'+ cat_images[index]['category_images'][i]['image_path'] +'"></a>';
        }

        $('.iCatImagesDiv').html(images_html);
    }

    function search_cat_image()
    {
        if ($('#search_cat_image').val().length > 2)
        {
            var cat_images = JSON.parse(categories_and_images);

            var images_html = '';
            for (var i = 0; i < cat_images.length; i++)
            {
                for (var j = 0; j < cat_images[i]['category_images'].length; j++)
                {
                    if (cat_images[i]['category_images'][j]['image_name'] == $('#search_cat_image').val())
                    {
                        images_html += '<a href="javascript:void(0);"><img class="iCatImages" src="'+ cat_images[i]['category_images'][j]['image_path'] +'"></a>';
                    }
                }
            }

            $('.iCatImagesDiv').html(images_html);
        }
        else if ($('#search_cat_image').val().length == 0)
        {
            $("li.iActive a").click();
        }
    }
</script>