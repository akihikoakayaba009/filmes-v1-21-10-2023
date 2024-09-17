/* CATEGORIAS SLIDE */
document.addEventListener('DOMContentLoaded', function() {
  
  //CAROUSEL CATEGORIAS
  if(document.getElementsByClassName('splide-categorias').length){

    var nv_midia_tipo = new Splide( '.splide-categorias',{
      rewind: false,
      gap: '0.5rem',
      padding: 0,
      pagination: false,
      perPage: 6,
      perMove: 1,
      classes: {
        prev  : 'splide__arrow--prev prev',
        next  : 'splide__arrow--next next',
      },
      breakpoints: {
        991: {
          perPage: 4,
        },
        767: {
          perPage: 3,
        },
        480: {
          perPage: 2,
        },
  
      },
    });
    nv_midia_tipo.mount();
  }

  // RECOMENDADOS
  if(document.getElementsByClassName('recomendados').length){

    var recomendados = new Splide( '.recomendados',{
      rewind: false,
      gap: '0.5rem',
      padding: 0,
      pagination: false,
      perPage: 7,
      perMove: 1,
      classes: {
        prev  : 'splide__arrow--prev prev',
        next  : 'splide__arrow--next next',
      },
      breakpoints: {
        991: {
          perPage: 4,
        },
        480: {
          perPage: 3,
        },
  
      },
    });
    recomendados.mount();
  }   


  // NOVAS MIDIAS HOME
  var novas_midias = document.querySelectorAll('.splide');
  if(novas_midias.length){
      for(var i=0; i<novas_midias.length; i++){
          var splideElement = novas_midias[i];
          var splideDefaultOptions = 
          {
            rewind: false,
            gap: '0.5rem',
            padding: 0,
            pagination: false,
            perPage: 7,
            perMove: 1,
            classes: {
              prev  : 'splide__arrow--prev prev',
              next  : 'splide__arrow--next next',
            },
            breakpoints: {
              991: {
                perPage: 4,
              },
              480: {
                perPage: 3,
              },
        
            },
          }         
          var splide_novas_midias = new Splide( splideElement, splideDefaultOptions ); 
          // 3. mount/initialize this slider
          splide_novas_midias.mount();
      }
  }
  
  //CAROUSEL MIDIAS TIPO
  if(document.getElementsByClassName('splide-midia-tipo').length){

    var nv_midia_tipo = new Splide( '.splide-midia-tipo',{
      rewind: false,
      arrows: false,
      gap: '0.5rem',
      padding: 0,
      pagination: false,
      perPage: 6,
      perMove: 1,
      breakpoints: {
        991: {
          perPage: 4,
        },
        480: {
          perPage: 3,
        },
  
      },
    });
    nv_midia_tipo.mount();
  }



});