const SITE_URL = document.location.origin;

/* SWEET ALERT */
function ajax_processando() {
    Swal.fire({
        text: 'Por favor aguarde...',
        iconHtml: '<i class="fas fa-spinner fa-pulse text-dark"></i>',
        showConfirmButton: false,
        allowOutsideClick: false,
        customClass: {
            icon: 'sweet-icon-loading'
        }
    });
}

function ajax_carregando_midia($midia_tipo) {
    Swal.fire({
        text: 'Carregando '+$midia_tipo,
        iconHtml: '<i class="fas fa-spinner fa-pulse text-dark"></i>',
        showConfirmButton: false,
        allowOutsideClick: false,
        customClass: {
            icon: 'sweet-icon-loading'
        }
    });
}

function ajax_success(msg_success) {
    Swal.fire({
        icon: 'success',
        text: msg_success,
        showConfirmButton: true,
        allowOutsideClick: false,
        customClass: {
            icon: 'sweet-icon-success'
        }
    });
}

function ajax_success_redirect(msg_success, url) {
    Swal.fire({
        icon: 'success',
        text: msg_success,
        showConfirmButton: true,
        allowOutsideClick: false,
        customClass: {
            icon: 'sweet-icon-success'
        }
    }).then((result) => {
        //result isConfirmed;
        //result isDenied
        if(result.isConfirmed){
            window.location.href = url;
        }
    });
}

function ajax_success_reload(msg_success) {
    Swal.fire({
        icon: 'success',
        text: msg_success,
        showConfirmButton: true,
        allowOutsideClick: false,
        customClass: {
            icon: 'sweet-icon-success'
        }
    }).then((result) => {
        //result isConfirmed;
        //result isDenied
        if(result.isConfirmed){
            location.reload();
        }
    });
}

function ajax_error(msg_error) {
    Swal.fire({
        icon: 'warning',
        text: msg_error,
        allowOutsideClick: false,
        customClass: {
            icon: 'sweet-icon-error'
        }
    });
}


function ajax_error_reload(msg_error) {
    Swal.fire({
        icon: 'warning',
        text: msg_error,
        showConfirmButton: true,
        allowOutsideClick: false,
        customClass: {
            icon: 'sweet-icon-error'
        }
    }).then((result) => {
        //result isConfirmed;
        //result isDenied
        if(result.isConfirmed){
            location.reload();
        }
    });
}

function ajax_error_redirect(msg_error, url) {
    Swal.fire({
        icon: 'warning',
        text: msg_error,
        showConfirmButton: true,
        allowOutsideClick: false,
        customClass: {
            icon: 'sweet-icon-error'
        }
    }).then((result) => {
        //result isConfirmed;
        //result isDenied
        if(result.isConfirmed){
            window.location.href = url;
        }
    });
}

function admin_ajax(pg) {
	return SITE_URL + '/controller/admin/' + pg + '?ajax=ajax';
}

function admin_submit_form(form, pagina){
    var data = "";
    $('.form__textarea').each(function(){
        if($(this).prop('id') != null){
            for (instance in CKEDITOR.instances ) {
                CKEDITOR.instances[$(this).prop('id')].updateElement();
            }
        }
        });
    $.ajax({
        url: admin_ajax(pagina),
        data: new FormData(form),
        method: "POST",
        async: true,
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function () {
            ajax_processando(); 
        },
        success: function (res) {
            
            try {
                data = JSON.parse(res);
                if(data.status == 'success'){
                    ajax_success(data.msg);
                }else if(data.status == 'success_reload'){
                    ajax_success_reload(data.msg);
                }else if(data.status == 'success_redirect'){
                    ajax_success_redirect(data.msg, data.url);
                }else if(data.status == 'redirect_after_confirm'){ 
                    ajax_success_redirect(data.msg, data.url);       
                }else if(data.status == 'error'){
                    ajax_error(data.msg);
                }else if(data.status == 'error_reload'){
                    ajax_error_reload(data.msg);
                }else if(data.status == 'error_redirect'){
                    ajax_error_redirect(data.msg, data.url);
                }else if(data.status == 'reload'){
                    location.reload();
                }else if(data.status == 'redirect_url'){
                    window.location.href = data.url;
                }else if(data.status == 'login'){
                    location.reload();    
                }else{
                    ajax_error("O servidor enviou uma resposta inesperada. Tente novamente.");
                }
     
            } catch (_) {
                ajax_error("Ocorreu um problema. Tente mais tarde...");
            }
        },
        error: function () {
            ajax_error("Página não encontrada.");
        }
    });
}

/* SIDEBAR LEFT */
$(".open-sidebar-left").on("click", function(){
    if($(this).hasClass("open")){
        $(this).html('<i class="fas fa-bars"></i>');
        $("#sidebar-left").css("left","-270px");
        $(this).removeClass("open");
    }else{
        $(this).html('<i class="fas fa-times"></i>');
        $("#sidebar-left").css("left","0");
        $(this).addClass("open");
    }
});

$(window).resize(function(){
   if($(this).width() >= 1200){
        $("#sidebar-left").css("left","0");
        $(this).addClass("open");
   }else{
        $("#sidebar-left").css("left","-270px");  
        $(this).removeClass("open");
   }
});


/*
*  EXIBIR A IMAGEM CARREGADA 
*/

$(".input-image-change").change(function () {
	show_image_on_chage(this, ".load-image-on-change"); 
});

$(".input-image-change-two").change(function () {
	show_image_on_chage(this, ".load-image-on-change-two"); 
});

function show_image_on_chage(input, src_image) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$(src_image).attr('src', e.target.result);
			$(src_image).fadeIn(); 
		}

		reader.readAsDataURL(input.files[0]);
	}
}

/* MASKS */
if ($(".telefone") !== null) {
	$(".telefone").mask('(00)0000-0000');
}
if ($(".celular") !== null) {
	$(".celular").mask('(00)00000-0000');
}
if ($(".preco") !== null) {
	$(".preco").mask('0.000.000,00', { reverse: true });
}
if($(".whatsapp") !== null){
	$(".whatsapp").mask('+00 (00) 00000-0000');
}  
if($(".avaliacao") !== null){
    $(".avaliacao").mask("000%", {reverse:true});
}
if($(".ano") !== null){
    $(".ano").mask("0000");
}
if($(".midia_tmdb") !== null){
    $(".midia_tmdb").mask("0000000000000");
}
if($(".duracao") !== null){
    $(".duracao").mask("00:00:00", {reverse:true});
}

if($(".numero-3") !== null){
    $(".numero-3").mask("000");
}

/* SENHA */
function getPassword() {
	var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJLMNOPQRSTUVWXYZ!@#$%";
	var passwordLength = 12;
	var password = "";

	for (var i = 0; i < passwordLength; i++) {
		var randomNumber = Math.floor(Math.random() * chars.length);
		password += chars.substring(randomNumber, randomNumber + 1);
	}
	return password;
}

/* DATATABLE */
if($("#dataTable").length){ 
    $('#dataTable').DataTable( {
        "order": [],
        language: { 
            sSearch: "",
            sSearchPlaceholder: "Buscar",
            sLengthMenu: "_MENU_",
            sInfo: "Exibindo _END_ de _MAX_ resultados",
            sInfoEmpty: "",
            sInfoFiltered:"",
            sEmptyTable: "Nenhum registro encontrado",
            sZeroRecords: "Nenhum registro encontrado",
            paginate: {
                next: '<i class="fas fa-arrow-right"></i>', 
                previous: '<i class="fas fa-arrow-left"></i>'
            }
        },
        
    }); 
}

/* ADMIN ONLINE */
function admin_online(){
    $.ajax({
        url: SITE_URL+'/controller/admin/admin_online.php',
        method: "POST",
        data: {admin_online:"admin_online"},
    });
} 
setInterval(function(){
    admin_online();
},30000);
admin_online();