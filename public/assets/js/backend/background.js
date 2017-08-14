$(document).ready(function()
{
    backgroundImageBind(0);

    for (var i = 0; i < bindData.length; i++) {
        backgroundImageBind(bindData[i].id, bindData[i].id);
    }

    $(document).on('click', 'a.deleteImage', function(){
        deleteImage($(this).attr('data-delete-id'));
    });
});
function backgroundImageBind(selector, id)
{
    var photoId = '';
    if(id != '')
    {
        photoId = id;
    }

    $('#imageUpload-'+selector).fileupload({
        add: function(e, data) {
            var uploadErrors = [];
            var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
            if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                uploadErrors.push('Not an accepted file type. try using gif, jpeg, jpg, png');
            }

            if(uploadErrors.length > 0) {
                alert(uploadErrors.join("\n"));
            } else {
                $('div.loader').append('<div id="progress-'+ data.files[0].lastModified +'" class="progress"><div class="progress-bar progress-bar-success"></div><a href="javascript:void(0)" class="cancelProcess" id="cancel-'+ data.files[0].lastModified +'"><i class="fa fa-close"></i></a></div>');
                data.submit();
                $(document).on('click', 'a#cancel-'+data.files[0].lastModified, function (e) {
                    data.abort();
                    $('#progress-'+ data.files[0].lastModified +' .progress-bar').removeClass('progress-bar-success')
                        .addClass('progress-bar-danger')
                        .text('Cancelled');
                    $('#progress-'+ data.files[0].lastModified).fadeOut(800, function(){
                        $(this).remove();
                    });
                });
            }
        },
        url: '/manage/background/uploadImage',
        dataType: 'json',
        formData : {'oldRecordId' : photoId, 'folderName' : 'backgrounds' },
        done: function (e, data) {
            var retData = data.result;
            if(!$.isEmptyObject(retData))
            {
                if(retData.status == 'success')
                {
                    if(typeof photoId !== 'undefined')
                    {
                        $('ul#imageHolder li#image-container-'+ retData['id'] +' img').attr('src', retData['path']);
                    }
                    else
                    {
                        var str = '';
                        str = '<li class="" id="image-container-'+ retData['id'] +'">'+
                                    '<div class="text-center"><img src="'+ retData['path'] +'"></div>'+
                                    '<div class="text-center">'+
                                        '<span class="fileinput-button upload-image-button">'+
                                            '<span>Change</span>'+
                                            '<input type="file" name="backgound" id="imageUpload-'+ retData['id'] +'">'+
                                        '</span>'+
                                        '&nbsp;&nbsp;'+
                                        '<a href="javascript:void(0)" data-delete-id="'+ retData['id'] +'" class="deleteImage">Delete</a>'+
                                    '</div>'+
                                '</li>';
                        $('ul#imageHolder').prepend(str);
                        backgroundImageBind(retData['id'], retData['id']);
                    }
                }
                else
                {
                    alert(retData.msg);
                }
            }
            $('#progress-'+ data.files[0].lastModified).remove();
        },
        progress: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress-'+ data.files[0].lastModified).removeClass('hide');
            $('#progress-'+ data.files[0].lastModified +' .progress-bar').css('width',progress + '%').text(data.files[0].name);

            if(progress == 100)
            {
                $('a#cancel-'+data.files[0].lastModified).remove();
            }
        },
    }).prop('disabled', !jQuery.support.fileInput).parent().addClass(jQuery.support.fileInput ? undefined : 'disabled')
    .bind('fileuploadstart', function (e, data) {
        // $('#progress').addClass('hide');
        // $('#progress .progress-bar').css('width','0%');
    });    
}

function deleteImage(id)
{
    if(window.confirm('Are you sure to delete the background.'))
    {
        $.ajax({
            url: '/manage/background/delete_image',
            type: 'post',
            dataType: 'json',
            data: {'id' : id},
            success: function (response)
            {
                if (response.status)
                {
                    $('ul#imageHolder li#image-container-'+ id).fadeOut(800, function(){ $(this).remove();});
                }
            }
        });
    }
}