$(document).ready(function(){
    $('#seal').on('change', function() {
        alertify.success("Téléchargement...");
    var file_data = $(this).prop('files')[0];   
    var form_data = new FormData();
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1)   {
        alertify.error("Seules les images jpg et png sont autorisées");
        return;
    }  
    var picsize = (file_data.size);
    console.log(picsize); /*in byte*/
    if(picsize > 10097152) /* 10mb*/
        {
            alertify.error("Image autorisée inférieure à 10 Mo")
            return;
        }
    form_data.append('file', file_data);   
    $.ajax({
        url: 'uploadimg.php', /*point to server-side PHP script */
        dataType: 'text',  /* what to expect back from the PHP script, if anything*/
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(res){
            alertify.success('Image téléchargée avec succès');
           document.getElementById('sealto').value = res;
           document.getElementById('sealimg').setAttribute('src', res);
        }
     });
});

$('#signature').on('change', function() {
        alertify.success("Téléchargement...");
    var file_data = $(this).prop('files')[0];   
    var form_data = new FormData();
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1)   {
        alertify.error("Seules les images jpg et png sont autorisées");
        return;
    }  
    var picsize = (file_data.size);
    console.log(picsize); /*in byte*/
    if(picsize > 10097152) /* 10mb*/
        {
            alertify.error("Image autorisée inférieure à 10 Mo")
            return;
        }
    form_data.append('file', file_data);   
    $.ajax({
        url: 'uploadimg.php', /*point to server-side PHP script */
        dataType: 'text',  /* what to expect back from the PHP script, if anything*/
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(res){
            alertify.success('Image téléchargée avec succès');
           document.getElementById('signatureto').value = res;
           document.getElementById('signatureimg').setAttribute('src', res);
        }
     });
});




$('#sealt').on('change', function() {
        alertify.success("Téléchargement...");
    var file_data = $(this).prop('files')[0];   
    var form_data = new FormData();
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1)   {
        alertify.error("Seules les images jpg et png sont autorisées");
        return;
    }  
    var picsize = (file_data.size);
    console.log(picsize); /*in byte*/
    if(picsize > 10097152) /* 10mb*/
        {
            alertify.error("Image autorisée inférieure à 10 Mo")
            return;
        }
    form_data.append('file', file_data);   
    $.ajax({
        url: 'uploadimg.php', /*point to server-side PHP script */
        dataType: 'text',  /* what to expect back from the PHP script, if anything*/
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(res){
            alertify.success('Image téléchargée avec succès');
           document.getElementById('sealtot').value = res;
           document.getElementById('sealimgt').setAttribute('src', res);
        }
     });
});

$('#signaturet').on('change', function() {
        alertify.success("Téléchargement...");
    var file_data = $(this).prop('files')[0];   
    var form_data = new FormData();
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1)   {
        alertify.error("Seules les images jpg et png sont autorisées");
        return;
    }  
    var picsize = (file_data.size);
    console.log(picsize); /*in byte*/
    if(picsize > 10097152) /* 10mb*/
        {
            alertify.error("Image autorisée inférieure à 10 Mo")
            return;
        }
    form_data.append('file', file_data);   
    $.ajax({
        url: 'uploadimg.php', /*point to server-side PHP script */
        dataType: 'text',  /* what to expect back from the PHP script, if anything*/
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(res){
            alertify.success('Image téléchargée avec succès');
           document.getElementById('signaturetot').value = res;
           document.getElementById('signatureimgt').setAttribute('src', res);
        }
     });
});



});