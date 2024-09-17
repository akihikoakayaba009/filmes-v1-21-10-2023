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

function ajax_carregando_midia(midia_tipo) {
    Swal.fire({
        text: 'Carregando '+midia_tipo,
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

function user_ajax(pg) {
	return SITE_URL + '/controller/user/' + pg + '?ajax=ajax';
}

function user_submit_form(form, pagina){
    var data = "";
    $.ajax({
        url: user_ajax(pagina),
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
                }else if(data.status == 'perfil-select'){
                    ajax_error_redirect("Esta tela já está em uso. Selecione outra.", SITE_URL+'/user/perfil-select');
                    setTimeout(function(){
                           window.location.href = SITE_URL+'/user/perfil-select'; 
                    },3000)    
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

/*
*  EXIBIR A IMAGEM CARREGADA 
*/

$(".input-image-change").change(function () {
	show_image_on_chage(this); 
});

function show_image_on_chage(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('.load-image-on-change').attr('src', e.target.result);
			$(".load-image-on-change").fadeIn(); 
		}

		reader.readAsDataURL(input.files[0]);
	}
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

/* BUSCA */
var modalBuscar = document.getElementById('modal-buscar');
modalBuscar.addEventListener('show.bs.modal', event => {
    setTimeout(function(){
        $("input").focus();
    },100)
});
$("#form-busca").on("submit", function(e){
    e.preventDefault();

    const sti = $("input[name=input-busca]").val();

    var esp = "";
    for(var ei = 0; ei<sti.length; ei++){
        esp += " ";
    }
    if(sti == esp){
        return false;
    }
    const parsed = sti.normalize('NFD').replace(/([\u0300-\u036f]|[^0-9a-zA-Z ])/g, '');

    var str = parsed.replace(/[ ]/g,"-");
 
    var busca = str.toLowerCase();

    window.location.href = "/busca/midia/"+busca+'/pagina/1';
});


function cad_user_online(){
    $.ajax({
        url:  SITE_URL+"/controller/user/user_online.php",
        method: "POST",
        data: {acao:'cad-user-online'},
        success: function(res){
            
        }
    })
}

setInterval(function(){
    cad_user_online();
},5000);
cad_user_online();

