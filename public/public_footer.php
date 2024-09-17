<?php  cadastrar_visita();?>

<script src="<?php echo BASE_JS_PUBLIC;?>jquery.js?site_cache=<?php echo SITE_CACHE;?>"></script>   
<script src="<?php echo BASE_JS_PUBLIC;?>bootstrap.bundle.js?site_cache=<?php echo SITE_CACHE;?>"></script> 
<script src="<?php echo BASE_PLUGINS;?>sweetalert/sweetalert.js?site_cache=<?php echo SITE_CACHE;?>"></script> 
<script src="<?php echo BASE_JS_PUBLIC;?>jquery.mask.js?site_cache=<?php echo SITE_CACHE;?>"></script> 
<script src="<?php echo BASE_PLUGINS;?>splide/splide.min.js?site_cache=<?php echo SITE_CACHE;?>"></script> 
<script src="<?php echo BASE_PLUGINS;?>splide/splide-public.js?site_cache=<?php echo SITE_CACHE;?>"></script>
<script src="<?php echo BASE_JS_PUBLIC;?>public.js?site_cache=<?php echo SITE_CACHE;?>"></script>  
<script src="https://cdn.jwplayer.com/libraries/YR3QSwQg.js"></script>


<?php if($user_logado):?>
    <script>
      function v_status(){
        $.ajax({
          url: "<?php echo SITE_URL;?>/controller/user/user_controller.php?ajax=ajax",
          method: "GET",
          success: function(v){
              try{
                var v_user = JSON.parse(v);
                if(v_user.status == 'perfil-select'){
                    window.location.href = "<?php echo BASE_USER;?>perfil-select";
                }
                if(v_user.status == 'login'){
                    window.location.href = "<?php echo BASE_USER;?>login";
                }
              }catch(a){
                
              }
          }
      })
      }
      v_status();
      setInterval(function(){
        v_status();
      },5000);
    </script>
<?php endif;?>