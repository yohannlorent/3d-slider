<?php
/**
 * Template Name: Slider 3d
 */

get_header();

?>
   <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
   <script type="text/javascript" src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

   <link href="https://code.jquery.com/ui/1.11.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />

<div class="content3dSlider">
	<div class="fond"></div>
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lumiereblanche.png" class="lumiereblanche">
	

	<?php

// check if the repeater field has rows of data
if( have_rows('repeteur') ):

 	// loop through the rows of data
    while ( have_rows('repeteur') ) : the_row();
?>
        <div class="slide" bgcolor="<?php echo the_sub_field('couleur_de_fond'); ?>">
    		<div class="produit"><img src="<?php echo the_sub_field('image_produit'); ?>"></div>
			<div class="titre"><?php echo the_sub_field('titre_produit'); ?></div>
			<div class="chapeau"><?php echo the_sub_field('chapeau_produit'); ?></div>
			<div class="push" bgcolor="<?php echo the_sub_field('couleur_push'); ?>"></div>
			<div class="bienfait01"><?php echo the_sub_field('bienfait_01'); ?></div>
			<div class="bienfait02"><?php echo the_sub_field('bienfait_02'); ?></div>
			<div class="bienfait03"><?php echo the_sub_field('bienfait_03'); ?></div>	
 		</div>
        
<?php
    endwhile;

else :

    // no rows found

endif;

?>
	
	
	
	
</div>



<style type="text/css">

	@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,800');

	
  	body{
   	 	margin:0;
    	padding:0;
	}
	.content3dSlider{
		overflow:hidden;
		width:100%;
		height:100vh;
		position:relative;
	}
	.fond{
		position:absolute;
		z-index:80;
		top:0;
		left:0;
		width:100%;
		height:100%;
		background-color:#fcc133;
	}
	
	.lumiereblanche{
		position:absolute;
		z-index:85;
		width:100%;
		height:auto;
		top:50%;
	    left:50%;
	    -ms-transform: translate(-50%, -50%); /* IE 9 */
   		-webkit-transform: translate(-50%, -50%); /* Safari */
	    transform: translate(-50%, -50%);
	    
	}
	
	
	

	
</style>

<script>

   $( window ).on( "load", function() {
	   
	   
	    //Création du tableau contenant les images du slider
        window.produits=new Array();
	    window.titres=new Array();
	    window.chapeaux=new Array();
	    window.bienfaits1=new Array();
	    window.bienfaits2=new Array();
	    window.bienfaits3=new Array();
	    window.couleurfond=new Array();
	    window.couleurpushs=new Array();
	   
	   
	   //pour chaque div
          $.each($(".slide") , function (l){ 
            //on stocke la valeur de l'image dans le tableau
             produits[l]=$(this).children( '.produit' ).children( 'img' ).attr('src');
			 titres[l]=$(this).children( '.titre' ).html();
			 chapeaux[l]=$(this).children( '.chapeau' ).html();
			 bienfaits1[l]=$(this).children( '.bienfait01' ).html();
			 bienfaits2[l]=$(this).children( '.bienfait02' ).html();
			 bienfaits3[l]=$(this).children( '.bienfait03' ).html();
			 couleurpushs[l]=$(this).children( '.push' ).attr('bgcolor');
			 couleurfond[l]=$(this).attr('bgcolor');
			  
             //On supprime la div
              $(this).remove();
          });
	   
	 /*
	   
	   window.produits=['ananas.png','citrons.png','fraises.png'];
	   window.titres=['Ananas','Citron vert','Fraises'];
	   window.chapeaux=['Botaniquement parlant, l’ananas n’est pas un fruit, mais une multitude de baies qui se sont formées après la fusion des fleurs sur l’épi. Chacun des « yeux » ou renflements de l’écorce constitue une baie, donc un fruit.','Que ce soit pour améliorer la santé en général, pour contrôler votre poids, ou pour combattre divers trouble, les qualités du citron vert peuvent être très utiles. ','Ce petit fruit rouge est riche en vitamines et minéraux et possède de nombreux bienfaits pour la santé.'];
	   window.bienfaits1=['propriétés anti-inflammatoires','Amélioration du système immunitaire','sources de fibres '];
	   window.bienfaits2=['excellente source de manganèse','propriétés anti-inflammatoires','sources de manganèse'];
	   window.bienfaits3=['source de vitamine C','Bon pour perdre du poids','riches en vitamine C'];
	   window.couleurfond=['#fcc133','#b8d431','#f1524e'];
	   window.couleurpushs=['#614809','#285211','#660e0c'];*/
	   
	   //on initialise l'index tableau
	   window.i=0;
	   
	   //on initialise la viariable z-index
	   window.zindex=500;
	   
	   //INIT-- création de variable d'initialisation pour la première fois où on arrive sur le site
 		window.varInit=0;

 		//INIT-- on initialise le sens d'aniamtion des slide
 		window.sensSlide=1;
	   
	   //on crée le conteneur des bullet points
		$('body').append("<div class='conteneur-bullet-points'></div>");
	    //on y applique son style
	   $('.conteneur-bullet-points').css('position','absolute');
	   $('.conteneur-bullet-points').css('bottom','20px');
	   $('.conteneur-bullet-points').css('left','50%');
	   $('.conteneur-bullet-points').css('z-index','990');
	   $('.conteneur-bullet-points').css('-webkit-transform','translateX(-50%)');
	   $('.conteneur-bullet-points').css('-ms-transform','translateX(-50%)');
	   $('.conteneur-bullet-points').css('transform','translateX(-50%)');
	   
	
	   
	   //creation de la flèche gauche
	   $('.conteneur-bullet-points').append("<div class='left'></div>");
	   $('.left').css('width','17px');
	   $('.left').css('height','28px');
	   $('.left').css('float','left');
	   $('.left').css('position','relative');
	   $('.left').css('margin-top','3px');
	   $('.left').css('margin-right','20px');
	   
	   $('.left').append("<div class='left-barre-haut'></div>");
	   $('.left-barre-haut').css('position','absolute');
	   $('.left-barre-haut').css('right','0');
	   $('.left-barre-haut').css('top','8px');
	   $('.left-barre-haut').css('width','100%');
	   $('.left-barre-haut').css('height','3px');
	   $('.left-barre-haut').css('background-color','#fff');
	   $('.left-barre-haut').css('border-radius','3px');
	   $('.left-barre-haut').css('transform','rotate(-45deg)');
	   
	    $('.left').append("<div class='left-barre-bas'></div>");
	   $('.left-barre-bas').css('position','absolute');
	   $('.left-barre-bas').css('right','0');
	   $('.left-barre-bas').css('top','18px');
	   $('.left-barre-bas').css('width','100%');
	   $('.left-barre-bas').css('height','3px');
	   $('.left-barre-bas').css('background-color','#fff');
	   $('.left-barre-bas').css('border-radius','3px');
	   $('.left-barre-bas').css('transform','rotate(45deg)');
	   
	   //Au rollover
		$('.left').mouseover(function() {
			
			$('.left-barre-haut').css('background-color',couleurpushs[i]);
			$('.left-barre-bas').css('background-color',couleurpushs[i]);
			$(this).css('cursor', 'pointer');
		});
			
		//Au rollout
		$('.left').mouseout(function() {
		
			$('.left-barre-haut').css('background-color','#fff');
			$('.left-barre-bas').css('background-color','#fff');
		});
	   
	   
	   
         //INIT -- lorsqu'on clique sur le bouton precedent
        	$('.left').click(function() {
            //on décrémente le z-index
            zindex--;
            //on incrémentde l'index / si on est à al fin du tableau on revient au début
            i--;
            if (i<0){
               i=produits.length-1;
            }
             //on indique el sens d'animation
            sensSlide=0;
				//on incrémente var init pour dire qu'on est plus sur al première slide on qu'on peut donc faire des animations
            varInit++;
            //on appelle la fonction qui ajoute une nouvelle slide
            chargement();

         //INIT - Fin d'action bouton suivant 
         });
	   
	   
	   
	   $('.bullet'+iter).css('width','16px');
	   //tant qu'il y a des slides...
	   	for(var iter = 0; iter < produits.length; iter++) {
			
			// on crée une bullet
			$('.conteneur-bullet-points').append("<div class='bullet"+iter+" bullet' id='"+iter+"'></div>");
			//on y applique un style
			$('.bullet'+iter).css('width','16px');
			$('.bullet'+iter).css('height','16px');
			$('.bullet'+iter).css('border-radius','16px');
			$('.bullet'+iter).css('background-color','#fff');
			$('.bullet'+iter).css('margin','10px');
			$('.bullet'+iter).css('float','left');
			
			//Au rollover
			$('.bullet'+iter).mouseover(function() {
				//si l'id de la bullet est egal à la slide actuelle
				if( $(this).attr("id") !=i){
					 $(this).animate({
		         		backgroundColor: couleurpushs[i]
		        	},"800", function() { });
					$(this).css('cursor', 'pointer');
				}
			});
			
			//Au rollout
		   $('.bullet'+iter).mouseout(function() {
			   //si l'id de la bullet est egal à la slide actuelle
			   if( $(this).attr("id") ==i){
				   
					$(this).css('background-color',couleurpushs[i]);
				}else{
				//sinon
					 $(this).animate({
		         		backgroundColor: '#fff'
		        	},"800", function() { });
				}
			});
			
			//Auclick
			$('.bullet'+iter).click(function() {
				
				
				//on détermine le sens d'animation
				if($(this).attr("id")<i){
					sensSlide=0;

				}else if($(this).attr("id")>i){
					sensSlide=1;
				}
				
				//Si on est pas sur la slide actuelle
				if($(this).attr("id") !=i){
					
					//on met l'identation à la meme valeur que l'id de la bullet
					i=$(this).attr("id");	
					//on décrémente le z-index
					zindex--;
					//on incrémente var init pour dire qu'on est plus sur al première slide on qu'on peut donc faire des animations
					varInit++;
					//on appelle la fonction qui ajoute une nouvelle slide
					chargement();
					
					

				}

			});

		}
	    
	    //creation de la flèche droite
	   $('.conteneur-bullet-points').append("<div class='droite'></div>");
	   $('.droite').css('width','17px');
	   $('.droite').css('height','28px');
	   $('.droite').css('float','left');
	   $('.droite').css('position','relative');
	   $('.droite').css('margin-top','3px');
	   $('.droite').css('margin-left','20px');
	   
	   $('.droite').append("<div class='droite-barre-haut'></div>");
	   $('.droite-barre-haut').css('position','absolute');
	   $('.droite-barre-haut').css('right','0');
	   $('.droite-barre-haut').css('top','8px');
	   $('.droite-barre-haut').css('width','100%');
	   $('.droite-barre-haut').css('height','3px');
	   $('.droite-barre-haut').css('background-color','#fff');
	   $('.droite-barre-haut').css('border-radius','3px');
	   $('.droite-barre-haut').css('transform','rotate(45deg)');
	   
	    $('.droite').append("<div class='droite-barre-bas'></div>");
	   $('.droite-barre-bas').css('position','absolute');
	   $('.droite-barre-bas').css('right','0');
	   $('.droite-barre-bas').css('top','18px');
	   $('.droite-barre-bas').css('width','100%');
	   $('.droite-barre-bas').css('height','3px');
	   $('.droite-barre-bas').css('background-color','#fff');
	   $('.droite-barre-bas').css('border-radius','3px');
	   $('.droite-barre-bas').css('transform','rotate(-45deg)');
	   
	   //Au rollover
		$('.droite').mouseover(function() {
			$('.droite-barre-haut').css('background-color',couleurpushs[i]);
			$('.droite-barre-bas').css('background-color',couleurpushs[i]);
			$(this).css('cursor', 'pointer');
		});
			
		//Au rollout
		$('.droite').mouseout(function() {
			$('.droite-barre-haut').css('background-color','#fff');
			$('.droite-barre-bas').css('background-color','#fff');
		});
	   
	    //INIT -- lorsqu'on clique sur le bouton suivant
         $('.droite').click(function() {
            //on décrémente le z-index
            zindex--;
            //on incrémentde l'index / si on est à al fin du tableau on revient au début
            i++;
            if (i==produits.length){
               i=0;
            }
            //on indique el sens d'animation
            sensSlide=1;
			  //on incrémente var init pour dire qu'on est plus sur al première slide on qu'on peut donc faire des animations
            varInit++;
			
            //on appelle la fonction qui ajoute une nouvelle slide
            chargement();
           
            
         //INIT - Fin d'action bouton suivant
         });
	  
	   
	   //on envoie au chargement l'image qu'on veut afficher
	   chargement();
   });
	
	///////////////////////////////////
	//      CHARGEMENT DS IMAGES     //
	///////////////////////////////////
   	function chargement(){
	
   		 //INIT- on applique un preload aux images servant à créer la slide
	   preloadPictures([produits[i]], function(){
	   		//si c'est chargé, on appelle la fonction qui va créer la slide
           changeSlide();
		});
   	}
	
	
	//FONCTION DE CREATION DE SLIDE
	function changeSlide(){
		
		//Si ce n'est aps la première slide, on anime la slide existante pour la faire disparaitre
		if(varInit>0){
			if(sensSlide==1){
				$('.slide'+(zindex+1)).animate({
				width:0,
				height:0,
				opacity:0
				},"slow", function() { 
				   //une fois sortie de l'écran on la supprime
				   $('.slide'+(zindex+1)).remove();
				});
				
				
			
				
			}else if(sensSlide==0){
				$('.slide'+(zindex+1)).animate({
				width:largeurimg*8,
				height:hauteurimg*8,
				top:$(window).height()*3.5,
				opacity:0
				},"slow", function() { 
				   //une fois sortie de l'écran on la supprime
				   $('.slide'+(zindex+1)).remove();
				});
				
				
			}
			$('.textegaughe'+(zindex+1)).animate({
				left: '-600px'
			},"slow");
			
			$('.paves'+(zindex+1)).animate({
				right:-600
			},"slow");
			
		}
		

		//on ajoute une div contenant le produit
		$('.content3dSlider').append("<div class='slide"+zindex+"'><img src='"+produits[i]+"'></div>");
		
		//on recupere la alrgeur et la hauteur de l'image pour la donner a la div la contenant
		//on pourra ensuite mettre l'image en 100% en hauteur et largeur pour jouer avec els hauteur et largeur du conteneur
		//pour que ca marche sur wordpress
		window.largeurimg=	$('.slide'+zindex+' img').width();
		window.hauteurimg=	$('.slide'+zindex+' img').height();
		
		$('.slide'+zindex).css('position','absolute');
		$('.slide'+zindex).css('top','50%');
		$('.slide'+zindex).css('left','50%');
		$('.slide'+zindex).css('z-index',zindex);
		$('.slide'+zindex).css('width',largeurimg);
		$('.slide'+zindex).css('height',hauteurimg);
		$('.slide'+zindex).css('-webkit-transform','translate(-50%,-50%)');
	    $('.slide'+zindex).css('-ms-transform','translate(-50%,-50%)');
	    $('.slide'+zindex).css('transform','translate(-50%,-50%)');
		
		//on met l'image à 100% du contenaur pour que ce soit avec la taille du conteneur que l'on joue
		$('.slide'+zindex+' img').css('width','100%');
		$('.slide'+zindex+' img').css('height','100%');
		
		
		
		//on anime
		
		if(sensSlide==1){
			//on agrandi et met en position l'image pour animation
			$('.slide'+zindex).css('width',largeurimg*8);
			$('.slide'+zindex).css('height',hauteurimg*8);
			$('.slide'+zindex).css('top',$(window).height()*3.5);
			$('.slide'+zindex).animate({
				top: '50%',
				width:largeurimg,
				height:hauteurimg
			},"slow");

		}else if(sensSlide==0){
			//on agrandi et met en position l'image pour animation
			$('.slide'+zindex).css('width',0);
			$('.slide'+zindex).css('height',0);
			$('.slide'+zindex).css('top','50%');
			$('.slide'+zindex).animate({
				width:largeurimg,
				height:hauteurimg
			},"slow");
		}
		
		
		$('.fond').animate({
			backgroundColor: couleurfond[i]
		},"slow");
		
		
		//on met a jour les bullets pour déterminer laquelle ne doit plus etre clickable
		$.each($(".bullet") , function (k){
			if( $(this).attr("id") ==i){
				$(this).css('background-color',couleurpushs[i]);
			}else{
				$(this).css('background-color','#fff');
			}
		});
		
		//on crée un conteneur pour le texte de gauche
		$('.content3dSlider').append("<div class='textegaughe"+zindex+"'></div>");
		$('.textegaughe'+zindex).css('position','absolute');
		$('.textegaughe'+zindex).css('top','50%');
		$('.textegaughe'+zindex).css('left','25px');
		$('.textegaughe'+zindex).css('z-index',zindex-10);
		$('.textegaughe'+zindex).css('width',"400px");
		$('.textegaughe'+zindex).css('-webkit-transform','translateY(-50%)');
	    $('.textegaughe'+zindex).css('-ms-transform','translateY(-50%)');
	    $('.textegaughe'+zindex).css('transform','translateY(-50%)');
		
		//on crée le titre
		$('.textegaughe'+zindex).append("<div class='titre'>"+titres[i]+"</div>");
		$('.titre').css('color','#fff');
		$('.titre').css('font-family','Open Sans, sans-serif;');
		$('.titre').css('font-weight','700');
		$('.titre').css('font-size','91px');
		$('.titre').css('line-height','70px');
		
		//on crée le chapeau
		$('.textegaughe'+zindex).append("<div class='chapeau'>"+chapeaux[i]+"</div>");
		$('.chapeau').css('color',couleurpushs[i]);
		$('.chapeau').css('font-family','Open Sans, sans-serif;');
		$('.chapeau').css('font-weight','400');
		$('.chapeau').css('font-size','18px');
		$('.chapeau').css('line-height','22px');
		$('.chapeau').css('margin-top','15px');
		
		//on crée le bouton
		$('.textegaughe'+zindex).append("<div class='3dpush'>En savoir +</div>");
		$('.3dpush').css('background-color',couleurpushs[i]);
		$('.3dpush').css('font-family','Open Sans, sans-serif;');
		$('.3dpush').css('font-weight','700');
		$('.3dpush').css('font-size','17px');
		$('.3dpush').css('line-height','21px');
		$('.3dpush').css('color','#fff');
		$('.3dpush').css('display','inline-block');
		$('.3dpush').css('margin-top','15px	');
		$('.3dpush').css('padding-left','60px');
		$('.3dpush').css('padding-right','60px');
		$('.3dpush').css('height','40px');
		$('.3dpush').css('padding-top','10px');
		$('.3dpush').css('border-radius','30px');
		
		//on anime le pavé de texte
		$('.textegaughe'+zindex).css('left','-600px');
		$('.textegaughe'+zindex).animate({
			left: '25px'
		},"slow");

		//on crée un conteneur pour les pavés de texte
		$('.content3dSlider').append("<div class='paves"+zindex+"'></div>");
		$('.paves'+zindex).css('position','absolute');
		$('.paves'+zindex).css('top','50%');
		$('.paves'+zindex).css('right','25px');
		$('.paves'+zindex).css('z-index',zindex-11);
		$('.paves'+zindex).css('width',"200px");
		$('.paves'+zindex).css('-webkit-transform','translateY(-50%)');
	    $('.paves'+zindex).css('-ms-transform','translateY(-50%)');
	    $('.paves'+zindex).css('transform','translateY(-50%)');
		$('.paves'+zindex).css('overflow','hidden');

		//on crée le pavé de droite 01
		$('.paves'+zindex).append("<div class='paves01'>"+bienfaits1[i]+"</div>");
		$('.paves01').css('font-family','Open Sans, sans-serif;');
		$('.paves01').css('font-weight','700');
		$('.paves01').css('font-size','14px');
		$('.paves01').css('line-height','16px');
		$('.paves01').css('color',couleurpushs[i]);
		$('.paves01').css('margin-bottom','20px');
		$('.paves01').css('width','200px');
		$('.paves01').css('padding','20px');
		$('.paves01').css('border-left','3px solid');
		$('.paves01').css('border-color',couleurpushs[i]);
		$('.paves01').css('text-transform','uppercase');
		$('.paves01').css('margin-left','250px');
		
		
		//on crée le pavé de droite 02
		$('.paves'+zindex).append("<div class='paves02'>"+bienfaits2[i]+"</div>");
		$('.paves02').css('font-family','Open Sans, sans-serif;');
		$('.paves02').css('font-weight','700');
		$('.paves02').css('font-size','14px');
		$('.paves02').css('line-height','16px');
		$('.paves02').css('color',couleurpushs[i]);
		$('.paves02').css('margin-bottom','20px');
		$('.paves02').css('width','200px');
		$('.paves02').css('padding','20px');
		$('.paves02').css('border-left','3px solid');
		$('.paves02').css('border-color',couleurpushs[i]);
		$('.paves02').css('text-transform','uppercase');
		$('.paves02').css('margin-left','250px');
		
		
		//on crée le pavé de droite 03
		$('.paves'+zindex).append("<div class='paves03'>"+bienfaits3[i]+"</div>");
		$('.paves03').css('font-family','Open Sans, sans-serif;');
		$('.paves03').css('font-weight','700');
		$('.paves03').css('font-size','14px');
		$('.paves03').css('line-height','16px');
		$('.paves03').css('color',couleurpushs[i]);
		$('.paves03').css('margin-bottom','20px');
		$('.paves03').css('padding','20px');
		$('.paves03').css('border-left','3px solid');
		$('.paves03').css('border-color',couleurpushs[i]);
		$('.paves03').css('text-transform','uppercase');
		$('.paves03').css('margin-left','250px');
		$('.paves03').css('width','200px');
		
		//on anime le pavé de droite 01
		setTimeout(activepave01, 100);
		//on anime le pavé de droite 02
		setTimeout(activepave02, 200);
		//on anime le pavé de droite 03
		setTimeout(activepave03, 300);
		
	}
	
	
	
	////////////////////////////////////////
	//            PRELOAD IMAGES          //
	////////////////////////////////////////
   //preload d'images
   var preloadPictures = function(pictureUrls, callback) {
    var i,
        j,
        loaded = 0;

    for (i = 0, j = pictureUrls.length; i < j; i++) {
        (function (img, src) {
            img.onload = function () {                               
                if (++loaded == pictureUrls.length && callback) {
                    callback();
                }
            };

            // Use the following callback methods to debug
            // in case of an unexpected behavior.
            img.onerror = function () {};
            img.onabort = function () {};

            img.src = src;
        } (new Image(), pictureUrls[i]));
    }
};
	
	function activepave01(){
		
		$('.paves01').animate({
			marginLeft: '0'
		},"slow");
	}
	function activepave02(){
		
		$('.paves02').animate({
			marginLeft: '0'
		},"slow");
	}
	
	function activepave03(){
		
		$('.paves03').animate({
			marginLeft: '0'
		},"slow");
	}
	
	

    
</script>

  
<?php get_footer(); ?>
