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
            var acceptFileTypes = /^image\/(swf|svg|wmf|emf|eps|dxf)$/i;
            if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                uploadErrors.push('Not an accepted file type. try using swf, svg, wmf, emf, eps, dxf');
            }
            if(uploadErrors.length > 0) {
                alert(uploadErrors.join("\n"));
            } else {
                data.submit();
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
                        str = '<li class="col-lg-3" id="image-container-'+ retData['id'] +'">'+
                                    '<div><img src="'+ retData['path'] +'"></div>'+
                                    '<div class="text-center">'+
                                        '<span class="fileinput-button">'+
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