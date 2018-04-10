<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>
<script>





	// Open the Modal
	function openModal() {
	  document.getElementById('myModal').style.display = "block";
	}

	// Close the Modal
	function closeModal() {
	  document.getElementById('myModal').style.display = "none";
	}

	var slideIndex = 1;
	var mytimeout;
	showSlides(slideIndex);

	// Next/previous controls
	function plusSlides(n) {
	  showSlides(slideIndex += n);
	}

	// Thumbnail image controls
	function currentSlide(n) {
	  showSlides(slideIndex = n);
	}

	function showSlides(n) {
	  var i;
	  var slides = document.getElementsByClassName("mySlides");
	  var slideImgs = document.getElementsByClassName("slideImg");
	  var thumbs = document.getElementsByClassName("thumb");
	  var descrs = document.getElementsByClassName("descr");
	  var dots = document.getElementsByClassName("dot");
	  var captionText = document.getElementById("caption");
	  var descrText = document.getElementById("description");
	  <{if $autoslide}>
	     for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		slideIndex++;
		if (slideIndex > slides.length) {slideIndex = 1}
		slides[slideIndex-1].style.display = "block";
		mytimeout = setTimeout(showSlides, <{$slideshowSpeed}>); // Change image every 2 seconds
	  <{else}>
		  if (n > slides.length) {slideIndex = 1}
		  if (n < 1) {slideIndex = slides.length}
		  for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		  }
		  slides[slideIndex-1].style.display = "block";
	  <{/if}>
	  <{if $showThumbs}>
		  for (i = 0; i < thumbs.length; i++) {
			thumbs[i].className = thumbs[i].className.replace(" thumb-active", "");
		  }
		  thumbs[slideIndex-1].className += " thumb-active";
	  <{else}>
		  for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" dot-active", "");
		  }
		  dots[slideIndex-1].className += " dot-active";
	  <{/if}>
	  <{if $title == 'true'}>
		captionText.innerHTML = slideImgs[slideIndex-1].alt;
		descrText.innerHTML = descrs[slideIndex-1].innerHTML;
	  <{/if}>
	}
</script>

<{if $images_nb > 0}>
	<div class='clear'></div>
	<!-- Images used to open the lightbox -->
	<div class="row">
		<{foreach item=image from=$images name=images}>
			<div class="column">
				<img src="<{$wggallery_upload_url}>/images/<{$source_preview}>/<{$image.name}>" onclick="openModal();currentSlide(<{$smarty.foreach.images.iteration}>)" class="img-responsive hover-shadow" alt="<{$image.title}>" >
				<span class="descr hidden"><{$image.desc}></span>
			</div>
		<{/foreach}>
	</div>

	<!-- The Modal/Lightbox -->
	<div id="myModal" class="modal">
		<span class="close cursor" onclick="closeModal()">&times;</span>
		<div class="modal-content">
			
			<{foreach item=image from=$images name=images}>
				<div class="mySlides<{if $autoslide}> fade<{/if}>">
					<div class="numbertext"><{$smarty.foreach.images.iteration}> / <{$images_nb}></div>
					<img class='slideImg' src="<{$wggallery_upload_url}>/images/<{$source}>/<{$image.name}>" style="width:100%" alt="<{$image.title}>">
				</div>
			<{/foreach}>
			
			<!-- Next/previous controls -->
			<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
			<a class="next" onclick="plusSlides(1)">&#10095;</a>
			<{if $title == 'true'}>
				<!-- Caption text -->
				<div class="caption-container">
					<p id="caption"></p>
					<p id="description">aaa</p>
					<{if $description == 'true'}>
						<p id="description"></p>
					<{/if}>
				</div>
			<{/if}>

			<div class="thumbs-container">
				<{foreach item=image from=$images name=images}>
					<{if $showThumbs}>
						<!-- Thumbnail image controls -->
						<img class="thumb" src="<{$wggallery_upload_url}>/images/thumbs/<{$image.name}>" onclick="currentSlide(<{$smarty.foreach.images.iteration}>)" alt="<{$image.title}>" >
						<span class='descr '><{$image.descr}></span>
					<{else}>
						<!-- The dots/circles -->
						<span class="dot" onclick="currentSlide(<{$smarty.foreach.images.iteration}>)"></span>
					<{/if}>
				<{/foreach}>
			</div>

		</div>
	</div> 
<{/if}> 	

<div class="clear spacer"></div>

<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}> 

<!-- Footer -->
<{include file='db:wggallery_admin_footer.tpl'}>