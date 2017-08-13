$(document).ready(function()
{
    libraryImageBind(0);

    $(document).on('click', 'a.imageDelete', function(){
        deleteImage($(this).attr('data-delete-id'), $(this).attr('data-id'));
    });

    $(document).on('click', 'a.softDelete', function(){
        deleteTempImage($(this).attr('data-delete-id'));
    });

    $(document).on('click', 'a.saveImage', function(){

        if ($(this).attr('data-id'))
        {
           saveImage($(this).attr('data-save-id'), $(this).attr('data-id'));
        }
        else
        {
            saveImage($(this).attr('data-save-id'));
        }
    });

    $(document).on('click', 'a.saveAll', function(){
        $('table tbody tr.savePending').each(function(i, o){
            var id = $(o).find('td a.saveImage').attr('data-save-id');
            saveImage(id);
        })
    });
    
    $('select[name="sorting"]').change(function(){
        window.location = window.location.origin + '/manage/library?sort='+ $(this).val();
    });

    $(document).on('click', 'a.editImage', function(){
        var id = $(this).attr('data-edit-id')
        $('table tbody tr#image-container-'+id).addClass('editPending');
        $('table tbody tr#image-container-'+id + ' td .editTool').removeClass('hide');
        $('table tbody tr#image-container-'+id + ' td .renderTool').addClass('hide');
    });

    for (var i = 0; i < bindData.length; i++) {
        editLibraryImageBind(bindData[i].key);
    }
    
});

function libraryImageBind(selector)
{
    $('#imageUpload-'+selector).fileupload({
        add: function(e, data) {
            var uploadErrors = [];
            var acceptFileTypes = /^image\/(gif|jpe?g|png|bmp)$/i;
            if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                uploadErrors.push('Not an accepted file type. try using gif, jpeg, jpg, png, bmp');
            }
            if(uploadErrors.length > 0) {
                alert(uploadErrors.join("\n"));
            } else {
                $('div.loader').append('<div id="progress-'+selector+'" class="progress"><div class="progress-bar progress-bar-success"></div></div>');
                
                data.submit();
            }
        },
        url: '/manage/library/uploadImage',
        dataType: 'json',
        formData : {'folderName' : 'library_temp' },
        done: function (e, data) {
            var retData = data.result;
            if(!$.isEmptyObject(retData))
            {
                if(retData.status == 'success')
                {
                    var sizeId = parseInt($('table tbody tr').length) + 1;
                    var str = '';
                    str =   '<tr id="image-container-'+ sizeId +'" class="savePending">'+
                                '<td></td>'+
                                '<td><img src="'+ retData['path'] +'" data-file-name="'+ retData['fileName'] +'"></td>'+
                                '<td>'+ categoryStructure +'</td>'+
                                '<td><input type="text" class="form-control" name="imageName"></td>'+
                                '<td><input type="text" class="form-control" name="imageSize"></td>'+
                                '<td><a href="javascript:void(0)" data-save-id="'+ sizeId +'" class="saveImage btn btn-default iBlueBtn btn-flat">Save</a></td>'+
                                '<td><a href="javascript:void(0)" data-delete-id="'+ sizeId +'" class="softDelete"><i class="fa fa-trash fa-2x"></i></a></td>'+
                                '</div>'+
                            '</tr>';
                    $('table tbody').prepend(str);
                    
                    //set table number
                    setTableNumbering();                        
                }
                else
                {
                    alert(retData.msg);
                }
            }
            $('#progress-'+selector).remove();
        },
        progress: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress-'+selector).removeClass('hide');
            $('#progress-'+selector+' .progress-bar').css('width',progress + '%').text(data.files[0].name);
        },
    }).prop('disabled', !jQuery.support.fileInput).parent().addClass(jQuery.support.fileInput ? undefined : 'disabled')
    .bind('fileuploadstart', function (e, data) {
        $('#progress-'+selector).addClass('hide');
        $('#progress-'+selector+' .progress-bar').css('width','0%');
    });    
}

function saveImage(id, serverId)
{
    $('tr#image-container-'+ id +' td input[type="text"]').attr('placeholder','').css('color','#000');
    if($('tr#image-container-'+id).length)
    {
        if (typeof serverId !== 'undefined')
        {
            var image = '';
            var is_changed = $('tr#image-container-'+ id +' td img').attr('data-edit');
            if(is_changed)
            {
                var image = $('tr#image-container-'+ id +' td img').attr('data-file-name');
            }
            var optionText = $('tr#image-container-'+ id +' td select[name="categoryName"] option:selected').text();
        }
        else
        {
            var image = $('tr#image-container-'+ id +' td img').attr('data-file-name');
        }
        var category = $('tr#image-container-'+ id +' td select[name="categoryName"]').val();
        var imageName = $('tr#image-container-'+ id +' td input[name="imageName"]').val();
        var imageSize = $('tr#image-container-'+ id +' td input[name="imageSize"]').val().trim();

        if(imageSize == '')
        {
            $('tr#image-container-'+ id +' td input[name="imageSize"]').attr('placeholder', '(required)').css('color','#ff0000');
            return false;
        }

        $.ajax({
            url: '/manage/library/save_image',
            type: 'post',
            dataType: 'json',
            data: {'image' : image, 'category' : category, 'imageName' : imageName, 'imageSize' : imageSize, 'serverId' : serverId},
            success: function (response)
            {
                if (typeof serverId !== 'undefined')
                {
                    $('table tbody tr#image-container-'+id).removeClass('editPending');
                    $('table tbody tr#image-container-'+id + ' td .editTool').addClass('hide');
                    $('table tbody tr#image-container-'+id + ' td .renderTool').removeClass('hide');

                    // image attribute update
                    $('tr#image-container-'+ id +' td img').removeAttr('data-edit');
                    $('tr#image-container-'+ id +' td img').removeAttr('data-file-name');

                    $('tr#image-container-'+ id +' td span#categoryName').text(optionText);
                    $('tr#image-container-'+ id +' td span#imageName').text(imageName);
                    $('tr#image-container-'+ id +' td span#imageSize').text(imageSize);
                }
                else
                {
                    $('tr#image-container-'+ id).removeClass('savePending');
                    $('a[data-save-id="'+ id +'"]').addClass('disabled').removeClass('saveImage');
                    $('a[data-delete-id="'+ id +'"]').removeClass('softDelete').addClass('imageDelete').attr('data-id', response);
                }
            }
        });
    }
}

function deleteImage(id, serverId)
{
    if(window.confirm('Are you sure to delete the image?'))
    {
        $.ajax({
            url: '/manage/library/delete_image',
            type: 'post',
            dataType: 'json',
            data: {'id' : serverId},
            success: function (response)
            {
                if (response.status)
                {
                    $('tr#image-container-'+ id).fadeOut(800, function(){
                        $(this).remove();
                        setTableNumbering();
                     });
                }
            }
        });
    }
}

function deleteTempImage(id)
{
    if(window.confirm('Are you sure to delete the image?'))
    {
        $('tr#image-container-'+ id).fadeOut(800, function(){
            $(this).remove();
            setTableNumbering();
         });
    }
}

function setTableNumbering()
{
    $('table tbody tr').each(function(i, o){
        $(o).find('td:first-child()').text(++i);
    });
}

function editLibraryImageBind(selector)
{
    $('#imageUpload-'+selector).fileupload({
        add: function(e, data) {
            var uploadErrors = [];
            var acceptFileTypes = /^image\/(gif|jpe?g|png|bmp)$/i;
            if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                uploadErrors.push('Not an accepted file type. try using gif, jpeg, jpg, png, bmp');
            }
            if(uploadErrors.length > 0) {
                alert(uploadErrors.join("\n"));
            } else {
                data.submit();
            }
        },
        url: '/manage/library/uploadImage',
        dataType: 'json',
        formData : {'folderName' : 'library_temp' },
        done: function (e, data) {
            var retData = data.result;
            if(!$.isEmptyObject(retData))
            {
                if(retData.status == 'success')
                {
                    $('tr#image-container-'+ selector +' td img').attr('data-edit', true);
                    $('tr#image-container-'+ selector +' td img').attr('src', retData['path']);
                    $('tr#image-container-'+ selector +' td img').attr('data-file-name', retData['fileName']);
                }
                else
                {
                    alert(retData.msg);
                }
            }
        },
        progress: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress').removeClass('hide');
            $('#progress .progress-bar').css('width',progress + '%');
        },
    }).prop('disabled', !jQuery.support.fileInput).parent().addClass(jQuery.support.fileInput ? undefined : 'disabled')
    .bind('fileuploadstart', function (e, data) {
        $('#progress').addClass('hide');
        $('#progress .progress-bar').css('width','0%');
    });    
}