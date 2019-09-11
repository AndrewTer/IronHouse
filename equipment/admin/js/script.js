$(document).ready(function(){
    $('.delete').click(function(){
        var rel = $(this).attr("rel");
        
        $.confirm({
            'title'   : 'Подтверждение удаления',
            'message' : 'После удаления восстановление будет невозможно! Продолжить?',
            'buttons' : {
                'Да'  : {
                    'class' : 'blue',
                    'action': function(){
                        location.href = rel;
                    }
                },
                'Нет' : {
                    'class' : 'gray',
                    'action': function(){}
                }
                
            }
        });
        
    });
    
$('#select-links').click(function(){
    $("#list-links").slideToggle(200);
    $("#list-links-sort").slideToggle(200);    
});  
       
$('.block-messages').click(function(){
 $(this).find('ul').slideToggle(300);   
    
});
 
$('.block-equipment-images').click(function(){
 $(this).find('ul').slideToggle(300);   
    
});
 
$('.h3click').click(function(){
 $(this).next().slideToggle(400);   
});

/*Добавление ссылки на добавление изображения*/ 
var count_input = 1;

$("#add-input").click(function(){
    count_input++;
    
    $('<div id="addimage'+count_input+'" class="addimage1"><input type="hidden" name ="MAX_FILE_SIZE" value="2000000" /><input type="file" name="galleryimg[]" /><a class="delete-input" rel="' + count_input + '" >Удалить</a></div>').fadeIn(300).appendTo('#objects');
});

/*Добавление ссылки на удаление изображения*/
$('.delete-input').live('click',function(){
    var rel = $(this).attr("rel");
    $("#addimage"+rel).fadeOut(300,function(){
    $("#addimage"+rel).remove();    
    });
}); 

/*Удаление картинок из части оборудования*/  
$('.del-img').click(function(){
var img_id = $(this).attr("img_id");
var title_img = $("#del"+img_id+" > img").attr("title");

$.ajax({
    type: "POST",
    url: "./actions/delete-gallery-equipment.php",
    data: "id="+img_id+"&title="+title_img,
    dataType: "html",
    cache: false,
    success: function(data){
        if (data == "delete")
        {
            $("#del"+img_id).fadeOut(300);
        }
    }
});    
});

/*Удаление картинок из части оборудования*/  
$('.del-img-service').click(function(){
var img_id = $(this).attr("img_id");
var title_img = $("#del"+img_id+" > img").attr("title");

$.ajax({
    type: "POST",
    url: "./actions/delete-gallery-services.php",
    data: "id="+img_id+"&title="+title_img,
    dataType: "html",
    cache: false,
    success: function(data){
        if (data == "delete")
        {
            $("#del"+img_id).fadeOut(300);
        }
    }
});    
});


});
