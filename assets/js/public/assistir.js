$(document).ready(function(){
    
    var player_trailer = '';

    var acao  = null; 
    var midia_id = $(".midia-intro").attr("data-id"); 
    var temporada_id = 0;
    var episodio_id  = 0;
    
    const modal_temporadas = document.getElementById('modal-temporadas');
    const moda_episodios   = document.getElementById('modal-episodios');
    const modal_assistir   = document.getElementById('modal-assistir');
    const modal_trailer    = document.getElementById('modal-trailer');
    
 
    $(".load-temporadas").on("click", function(){
        acao = 'load-temporadas';
        $.ajax({
         url: SITE_URL+"/controller/public/midia.php",
         method: "POST",
         data:{acao:acao,midia_id:midia_id},
         beforeSend: function(){
             ajax_processando();
         },
         success: function(temp){
            console.log(temp + " ps1")
             try{
                 var temporadas = JSON.parse(temp);
                 if(temporadas.status == 'ok'){
                     var temp_item = temporadas.array_temporadas;
                     var temp_html  = ''; 
                     for(var i=0; i < temp_item.length; i++){
                         temp_html += '<button type="button" class="list-group-item temporada-item d-flex justify-content-between" temporada_id="'+temp_item[i].temporada_id+'">';
                         temp_html += temp_item[i].temporada_titulo;
                         temp_html += '<span class="badge">'+temp_item[i].total_episodios;
                         temp_html += '</span></button>';
                     }
                     swal.close();
                     $(".modal-temporadas").html(temp_html);
                     $("#modal-temporadas").modal('show');
                 }else{
                    
                     if(temporadas.status == 'login'){
                        ajax_error("Acesse ou crie uma conta para assistir. É grátis.");
                        return false;
                     }else if(temporadas.status == 'login'){
                        ajax_error("Acesse ou crie uma conta para assistir. É grátis.");
                     }   
                     if(temporadas.status == 'error-temp-1'){
                         ajax_error("Não foi possível carregar as temporadas.");
                     }else if(temporadas.status == 'error-temp-2'){
                         ajax_error("Sem temporadas.");
                     }else{
                         ajax_error("Serviço indisponível no momento.");
                     } 
                 }
             }catch(temp_error){
                 ajax_error("Serviço indisponível no momento.");
             }
             
         }
       });
    });
 
    $(".modal-temporadas").on("click", ".temporada-item", function(){
         acao         = 'load_episodios'; 
         temporada_id = $(this).attr("temporada_id");
         $.ajax({
             url: SITE_URL+"/controller/public/midia.php",
             method: "POST",
             data:{acao:acao,midia_id:midia_id,temporada_id:temporada_id},
             beforeSend: function(){
                 ajax_processando();
             },
             success: function(ep){
                 try{
                     var episodios = JSON.parse(ep);
                     
                     var ep_html   = '';
                     if(episodios.status == 'ok'){
                        var ep_item = episodios.array_episodios;
 
                        for(var i = 0; i < ep_item.length; i++){
                             
                             ep_html += '<a type="button" class="list-group-item episodio-item" episodio_id="'+ep_item[i].episodio_id+'">';
                             if(ep_item[i].episodio_image != ''){
                                 ep_html += '<div class="image-group">';   
                                 ep_html += '<img src="'+ep_item[i].episodio_image+'" class="img-fluid">';
                                 ep_html += '</div>';
                             }else{
                                ep_html += '<div class="image-midia">';   
                                ep_html += '<img src="'+$(".midia-intro").attr('data-image')+'" class="img-fluid">';
                                ep_html += '</div>'; 
                             }
                             ep_html += '<div class="info-group">';
                             ep_html += '<small class="episodio-titulo"> Episódio ' +ep_item[i].episodio_numero+ '</small>';
                             if(ep_item[i].episodio_titulo != null && ep_item[i].episodio_titulo != ''){
                                 ep_html += '<small class="episodio-titulo">'+ep_item[i].episodio_titulo+'</small>';
                             }
                             if(ep_item[i].episodio_duracao !== null && ep_item[i].episodio_duracao != ""){
                                ep_html += '<small class="episodio-duracao">'+ep_item[i].episodio_duracao+'</small>';
                             }
                             if(ep_item[i].episodio_descricao !== '' && ep_item[i].episodio_descricao !== null){
                                 ep_html += '<small class="episodio-descricao">'+ep_item[i].episodio_descricao +'</small>';
                             }
                             ep_html += '</div>';
                             ep_html += '</a>';
                             
                        }
                        swal.close();
                        $(".modal-episodios").html(ep_html);
                        $("#modal-episodios").modal("show");
 
                     }else{
                         if(episodios.status == 'login'){
                            ajax_error("Acesse ou crie uma conta para assistir. É grátis.");
                            return false;
                         }else if(episodios.status == 'error-ep-1'){
                             ajax_error("Não foi possível carregar os episódios.");
                         }else if(episodios.status == 'error-ep-2'){
                             ajax_error("Temporada não encontrada.");
                         }else if(episodios.status == 'error-ep-3'){
                             ajax_error("Sem episódios.");
                         }else{
                             ajax_error("Serviço indisponível no momento.");
                         }
                     }
                 }catch(ep_error){
                     ajax_error("Serviço indisponível no momento.");
                 }
             }
       });
 
 
       $(".modal-episodios").on("click", ".episodio-item", function(){
             acao = 'load_players';
             episodio_id = $(this).attr("episodio_id");
             $.ajax({
                 url: SITE_URL+"/controller/public/midia.php",
                 method: "POST",
                 data:{acao:acao,midia_id:midia_id,temporada_id:temporada_id,episodio_id:episodio_id},
                 beforeSend: function(){
                     ajax_processando();
                 },
                 success: function(play){
                     try{
                       var players = JSON.parse(play);
       
                       if(players.status == 'ok'){
                         var play_item = players.array_players;
                         var play_html = '';
                         
                         if(players.total_players > 1){
                         
                         var mais_mais = 0;   
                         
                         for(var i = 0; i < play_item.length; i++){
                             mais_mais++
                             if(players.site_revenda == 'sim' && players.user_premium == 'sim'){

                                 
                                 play_html += '<a type="button" class="list-group-item d-flex justify-content-between align-items-center player-item" player_id="'+play_item[i].player_id+'">';


                                 if(play_item[i].player_titulo != '' && play_item[i].player_titulo != null){
                                    play_html += play_item[i].player_titulo + ' ' + play_item[i].player_audio; 
                                 }else{
                                    play_html += 'Player ' +  mais_mais + ' ' + play_item[i].player_audio; 
                                 }
                                 
                                 play_html += '<div class="badge gratis"><i class="fal fa-play"></i><span class="text">ASSISTIR</span></div>';
                                 play_html += '</a>'; 
 
                             }else{
                                 play_html += '<a type="button" class="list-group-item d-flex justify-content-between align-items-center player-item" player_id="'+play_item[i].player_id+'">';


                                 if(play_item[i].player_titulo != '' && play_item[i].player_titulo != null){
                                    play_html += play_item[i].player_titulo + ' ' + play_item[i].player_audio; 
                                 }else{
                                    play_html += 'Player ' +  mais_mais + ' ' + play_item[i].player_audio; 
                                 }
                              
                           
                                 if(play_item[i].player_acesso == 'gratis'){
                                     play_html += '<div class="badge gratis"><i class="fal fa-play"></i><span class="text">ASSISTIR</span></div>';
                                 }else{
                                     play_html += '<div class="badge premium"><i class="fal fa-lock"></i><span class="text">PREMIUM</span></div>';
                                 }
                                 play_html += '</a>';
                             }
                         }
 
                             swal.close();
                             $(".modal-players").html(play_html);
                             $("#modal-players").modal("show");
 
                         }else{
                             swal.close();
                             assistir(play_item[0].player_id);
                         }
                        
                       }else{
                         if(players.status == 'login'){
                            ajax_error("Acesse ou crie uma conta para assistir. É grátis.");
                            return false;
                         }else if(players.status == 'error-play-1'){
                             ajax_error("Não foi possível carregar os players.");
                         }else if(players.status == 'error-play-2'){
                             ajax_error("Temporada não encontrada.");
                         }else if(players.status == 'error-play-3'){
                             ajax_error("Episódio não encontrado.");
                         }else if(players.status == 'error-play-4'){
                             ajax_error("Player indisponível no momento.");    
                         }else{
                             ajax_error("Serviço indisponível no momento.");
                         }
                       }
                    }catch(play_error){
                       ajax_error("Serviço indisponível no momento.");
                    }
                 }
             });
       })
         
    });
 
 
    function assistir(player_id){
         acao = 'assistir';
         $.ajax({
                 url: SITE_URL+"/controller/public/midia.php",
                 method: "POST",
                 data:{acao:acao,midia_id:midia_id,temporada_id:temporada_id,episodio_id:episodio_id,player_id:player_id},
                 beforeSend: function(){
                     ajax_processando();
                 },
                 success: function(load){
                    console.log(load + " ps4")
                     try{
                         $(".assistir-player").html("");
                         var play = JSON.parse(load);
                         var player = play.player;
                    
                           
                         if(play.status == 'ok'){
                             var player = play.player;
                             var player_html = '';
                             if(player.player_acesso == 'premium'){
                                 if(play.user_premium != 'sim'){
                                     ajax_error("Para assistir assine um plano premium.");
                                     return false; 
                                 }
                             }
                             if(player.player_tipo == 'iframe'){
 
                                 player_html += '<div class="ratio ratio-16x9">';
                                 player_html += '<iframe src="'+player.player_url+'" title="YouTube video" allowfullscreen></iframe>';
                                 player_html += '</div>';
                                 $(".assistir-player").html(player_html);
 
                             }else if(player.player_tipo == 'm3u8'){
                                 $(".assistir-player").append('<div id="jw-player"></div>');
                                 jwplayer("jw-player").setup({ 
                                     "responsive": "true", 
                                     "aspectratio": "16:9",
                                     "mute": "false",
                                     "autostart": "false",
                                     "playlist": [{
                                     "file": player.player_url,
                                     "image": $(".midia-intro").attr("data-background"),
                                     }] 
                                 });   
                             }else if(player.player_tipo == 'mp4'){
                                 $(".assistir-player").append('<div id="jw-player"></div>');
                                 jwplayer("jw-player").setup({ 
                                     "responsive": "true", 
                                     "aspectratio": "16:9",
                                     "mute": "false",
                                     "autostart": "false",
                                     
                                     "playlist": [{
                                     "file": player.player_url,
                                     "image": $(".midia-intro").attr("data-background"),
                                     }] 
                                 });   
                             }else{
                                  ajax_error("Tente novamente mais tarde.");
                             }
              
                             $(".md-title").html(play.midia_titulo);

                             if(play.temporada_info != null && play.episodio_info != null){
                                $(".ep-title").html(play.temporada_info + ' ' + play.episodio_info); 
                             }                        
 
                             swal.close();
                             $("#modal-assistir").modal("show");

                             
 
                         }else{
                            if(play.status == 'login'){
                                ajax_error("Acesse ou crie uma conta para assistir. É grátis.");
                                return false;
                             }else if(play.status == 'error-assistir-1'){
                                 ajax_error("Não foi possível carregar os players.");
                             }else if(play.status == 'error-assistir-2'){
                                 ajax_error("Temporada não encontrada.");
                             }else if(play.status == 'error-assistir-3'){
                                 ajax_error("Episódio não encontrado.");
                             }else if(play.status == 'error-assistir-4'){
                                 ajax_error("Episódio não encontrado.");    
                             }else if(play.status == 'error-assistir-5'){ 
                                 ajax_error("Player indisponível no momento.");           
                             }else{
                                 ajax_error("Serviço indisponível no momento.");
                             } 
                         }
                     }catch(assistir_error){
                  
                         ajax_error("Serviço indisponível no momento.");
                     }
                 }
 
         });        
    }
 
    $(".modal-players").on("click", ".player-item", function(){
         assistir($(this).attr("player_id"));
    });
 
    $(".load-players").on("click", function(){
         acao = 'load_players';
         temporada_id = 0;
         episodio_id = 0;
         
         $.ajax({
                 url: SITE_URL+"/controller/public/midia.php",
                 method: "POST",
                 data:{acao:acao,midia_id:midia_id,temporada_id:temporada_id,episodio_id:episodio_id},
                 beforeSend: function(){
                     ajax_processando();
                 },
                 success: function(play){
                     try{
                       var players = JSON.parse(play);
                       if(players.status == 'ok'){
                         var play_item = players.array_players;
                         var play_html = '';
                         if(players.total_players > 1){ 
                         var zero = 0;
                         for(var i = 0; i < play_item.length; i++){
                             zero++
                             if(players.site_revenda == 'sim' && players.user_premium == 'sim'){
                                 play_html += '<a type="button" class="list-group-item d-flex justify-content-between align-items-center player-item" player_id="'+play_item[i].player_id+'">';

                                 if(play_item[i].player_titulo != '' && play_item[i].player_titulo != null){
                                    play_html += play_item[i].player_titulo + ' ' + play_item[i].player_audio; 
                                 }else{
                                    play_html += 'Player ' +  zero + ' ' + play_item[i].player_audio; 
                                 }
                                 
                                 play_html += '<div class="badge gratis"><i class="fal fa-play"></i><span class="text">ASSISTIR</span></div>';
                                 play_html += '</a>'; 
 
                             }else{
                                 play_html += '<a type="button" class="list-group-item d-flex justify-content-between align-items-center player-item" player_id="'+play_item[i].player_id+'">';
                                 
                                 if(play_item[i].player_titulo != '' && play_item[i].player_titulo != null){
                                    play_html += play_item[i].player_titulo + ' ' + play_item[i].player_audio; 
                                 }else{
                                    play_html += 'Player ' +  zero + ' ' + play_item[i].player_audio; 
                                 }
                                 
                              
                                 if(play_item[i].player_acesso == 'gratis'){
                                     play_html += '<div class="badge gratis"><i class="fal fa-play"></i><span class="text">ASSISTIR</span></div>';
                                 }else{
                                     play_html += '<div class="badge premium"><i class="fal fa-lock"></i><span class="text">PREMIUM</span></div>';
                                 }
                                 play_html += '</a>';
                             }
                         }
                             swal.close();
                             $(".modal-players").html(play_html);
                             $("#modal-players").modal("show");    
                        }else{
                            swal.close();
                            assistir(players.array_players[0].player_id)
                        }
                       }else{
                         if(players.status == 'login'){
                            ajax_error("Acesse ou crie uma conta para assistir. É grátis.");
                            return false;
                         }else if(players.status == 'error-play-1'){
                             ajax_error("Não foi possível carregar os players.");
                         }else if(players.status == 'error-play-2'){
                             ajax_error("Temporada não encontrada.");
                         }else if(players.status == 'error-play-3'){
                             ajax_error("Episódio não encontrado.");
                         }else if(players.status == 'error-play-4'){
                             ajax_error("Player indisponível no momento.");    
                         }else{
                             ajax_error("Serviço indisponível no momento.");
                         }
                       }
                    }catch(play_error){
                       ajax_error("Serviço indisponível no momento.");
                    }
                 }
             }); 
    });
    
    modal_assistir.addEventListener('hidden.bs.modal', event => {
         $(".assistir-player").html("");
         $("#jw-player").stop();
    });

    modal_trailer.addEventListener('show.bs.modal', event => {

        player_trailer += '<div class="ratio ratio-16x9">';
        player_trailer += '<iframe src="'+$(".open-trailer").attr("data-trailer")+'" title="YouTube video" allowfullscreen></iframe>';
        player_trailer += '</div>';
        $(".modal-trailer").html(player_trailer);
        
   });

   modal_trailer.addEventListener('hide.bs.modal', event => {
       player_trailer = '';
       $(".modal-trailer").html(""); 
   });
   

   $("#form-comentar").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url: SITE_URL+ '/controller/public/comentarios.php',
            method: "POST",
            data: $(this).serialize(),
            beforeSend: function(){
                ajax_processando("","Publicando comentário...");
            },
            success: function(com){
                swal.close();
                try{

                    var resp = JSON.parse(com);
               
                    if(resp.msg == 'error-1'){
                        ajax_error("Acesse a sua conta para comentar.");
                    }else if (resp.msg == 'error-2'){
                        ajax_error("Naõ foi possível enviar o seu comentário. Tente mais tarde.");
                    }else if (resp.msg == 'error-3'){
                        ajax_error("Escreva o seu comentário.");
                    }else if (resp.msg == 'publicado'){
                        load_comentarios(midia_id);
                        $("#comentario-textarea").val("");
                    }

                }catch(e){
                    ajax_error("Tente novamente mais tarde.");
                } 
                
            }
        });
    });


    function load_comentarios(midia_id){
        $.ajax({
            url:  public_ajax("comentarios.php"),
            method: "POST",
            data: {acao:"load-comentarios",midia_id:midia_id},
            success: function(com){
                 try{
                     var comentarios = JSON.parse(com);
                     var contar_comentarios = comentarios.length;
                     var com_html = '';
                     for(var i = 0; i < contar_comentarios; i++){

                        com_html += '<div class="comentario-item">';
                        com_html += '<img src="'+comentarios[i].avatar+'" class="img-fluid">';
                        com_html += '<div class="">';
                        com_html += '<small class="com-perfil">'+comentarios[i].perfil_apelido+'</small>';
                        com_html += '<small class="com-text">'+comentarios[i].comentario+'</small>';
                        com_html += '<small class="com-data">'+comentarios[i].data+'</small>';
                        com_html += '</div>';
                        com_html += '</div>';
                     }

                     $(".load-comentarios").html(com_html);
                 }catch(error_com){

                 }
            }     
         });
    }

    load_comentarios(midia_id);

    // MINHA LISTA
    $(".minha-lista-btn").on("click", function(){
        var res_list = '';
        $.ajax({
            url: SITE_URL+ '/controller/public/minha_lista.php',
            method: "POST",
            data: {midia_id:midia_id},
            success: function(list){
                var a = JSON.parse(list);
                if(a.msg == 'adicionado'){
                   $(".icon-lista-change").html('<i class="fas fa-check"></i>');
                }
                if(a.msg == 'removido'){
                    $(".icon-lista-change").html('<i class="fas fa-plus"></i>');
                }
                if(a.msg == 'error-1'){
                    ajax_error("Para adicionar ou remover da lista. Acesse a sua conta.");
                }
            }
        });
    });
   
});