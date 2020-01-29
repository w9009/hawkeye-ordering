let current_count = 0;
$(document).ready(function(){
    $('.name').click(function(){$('.name-invisible').removeClass('invisible') })
    $('.created_at').click(function(){$('.created_at-invisible').removeClass('invisible') })
    $('.updated_at').click(function(){$('.updated_at-invisible').removeClass('invisible') })
    $('.price').click(function(){$('.price-invisible').removeClass('invisible') })
    $('.amount').click(function(){$('.amount-invisible').removeClass('invisible') })
    $('.image').click(function(){$('.image-invisible').removeClass('invisible') })
    $('.delivery_time').click(function(){$('.delivery_time-invisible').removeClass('invisible') })
    $('.store').click(function(){$('.store-invisible').removeClass('invisible') })
    $('#add-category').click(function(){
        $('#new-category').removeClass('invisible');
        $(this).remove();
        $('#category').remove();
    })
        $('#part-list').on('click','.remove-item', function(){
            let li_parent = $(this).parent().parent()
            li_parent.remove()
        })

    $('.category-item').click(function (){
        current_count++;
        let value = $(this).val();
        let text = $(this).text();
        let category = $(this).attr('name');

        let input = document.createElement('input');
        let li = document.createElement('li');
        let p = document.createElement('p');
        let lable = document.createElement('lable');
        let div = document.createElement('div');
        let i = document.createElement('i');
        let trash_image_wrapper = document.createElement('div');

        let number_input = document.createElement('input');
        let part_list = document.getElementById('part-list');

        $(trash_image_wrapper).addClass('remove-item')
        $(p).text(text)
        $(p).val(category)

        $(i).addClass("fas fa-trash");
        $(div).addClass('input-wrapper');

        $(lable).text('quantity :');
        $(lable).attr('for', 'number-' + current_count.toString());

        $(number_input).val(value);
        $(number_input).attr('name', 'amount-' + current_count.toString());
        $(number_input).attr('type', 'number');
        $(number_input).attr('id', 'number-'+ current_count.toString());

        $(number_input).val('-');

        $(input).val(value);
        $(input).attr('name', 'part-' + current_count.toString())
        $(input).attr('type', 'hidden')

        $(div).append(lable);
        $(div).append(number_input);
        $(trash_image_wrapper).append(i)
        $(div).append(trash_image_wrapper)

        $(li).append(p);
        $(li).append(div);
        $(li).append(input);
        $(part_list).append(li);
    })
})