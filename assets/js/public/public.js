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
        iconHtml: '<i class="fas fa-spinner fa-pulse text-light"></i>',
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
        confirmButtonColor: "#0d2155",
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

function public_ajax(pg) {
	return SITE_URL + '/controller/public/' + pg + '?ajax=ajax';
}

function public_submit_form(form, pagina){
    var data = "";
    $.ajax({
        url: public_ajax(pagina),
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
        $("#page-content").removeClass("sidebar-open");
        
    }else{
        $(this).html('<i class="fas fa-times"></i>');
        $("#sidebar-left").css("left","0");
        $("#sidebar-left").addClass("open");
        $(this).addClass("open");
        $("#page-content").addClass("sidebar-open");
    }
});
$("#page-content").on("click", function(e){
    if($(this).hasClass("sidebar-open")){
        e.preventDefault();
        $(this).removeClass("sidebar-open");
        $("#sidebar-left").css("left","-270px");
        $("#sidebar-left").removeClass("open");
        $(".open-sidebar-left").removeClass("open");
        $(".open-sidebar-left").html('<i class="fas fa-bars"></i>');
    }
})

/* BUSCA */
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

$("#show-busca-one , #show-busca-two").on("click", function(){
    $(".container-busca").toggleClass("show");
    $("input[name=input-busca]").focus();
    $("input[name=input-busca]").val("");
})