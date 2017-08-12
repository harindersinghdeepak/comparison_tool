$(document).ready(function(){

});

function save_categories()
{
    $.ajax({
        url: 'categories/save_categories',
        type: 'post',
        dataType: 'json',
        data: {'form_data': $('#add_category_form').serialize()},
        success: function (response)
        {
            alert(response.message);
            if (response.status)
            {
                window.location.reload();
            }
        }
    })
}

function edit_category(ele, cat_id)
{
    var parent_tr = $(ele).parents('tr');
    var target_td = parent_tr.find('td.cat_nm_td');
    var target_input = target_td.find('input.cat_nm_txt');
    if (target_input.val() != '')
    {
        $.ajax({
            url: 'categories/edit_category',
            type: 'post',
            dataType: 'json',
            data: {'category_name': target_input.val(), 'id': cat_id},
            success: function (response)
            {
                if (response.status)
                {
                    var target_span = target_td.children("span").html(target_input.val());
                    target_span.toggleClass('hide');

                    target_input.toggleClass('hide');
                    $(ele).toggleClass('hide');
                    $(ele).siblings("a").toggleClass('hide');
                }

                alert(response.message);
            }
        })
    }
}

function delete_category(ele, cat_id)
{
    if(confirm('Are you sure?')) 
    {
        $.ajax({
            url: 'categories/delete_category',
            type: 'post',
            dataType: 'json',
            data: {'id': cat_id},
            success: function (response)
            {
                if (response.status)
                {
                    $(ele).parents('tr').remove();
                }

                alert(response.message);
            }
        })
    }
}

function edit_cat_toggle(ele)
{
    var target_td = $(ele).parents('tr').find('td.cat_nm_td');
    var target_span = target_td.children("span");
    var target_input = target_td.children("input");
    
    $(ele).toggleClass('hide');
    target_span.toggleClass('hide');
    $(ele).siblings("button.save_btn").toggleClass('hide');
    target_input.toggleClass('hide');
}