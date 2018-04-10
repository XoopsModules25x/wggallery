<!-- Header -->
<{include file='db:wggallery_admin_header.tpl'}>

<style>
.blueimp-gallery > .description {
  position: absolute;
  top: 30px;
  left: 15px;
  color: #fff;
  display: none;
}
.blueimp-gallery-controls > .description {
  display: block;
}
</style>

<{if $slideshowtype == 'lightbox'}>
    <{if $images_nb > 0}>
        <div id="links">
            <{foreach item=image from=$images}>
                <a href="<{$wggallery_upload_url}>/images/<{$source}>/<{$image.name}>" title="<{$image.title}>" data-description="This is a banana.">
                    <img src="<{$wggallery_upload_url}>/images/<{$source_preview}>/<{$image.name}>" alt="<{$image.title}>">
                </a>
            <{/foreach}>
        </div>
    <{/if}>
    <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <p class="description"></p>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>

    <script src="<{$wggallery_url}>/assets/galleries/blueimpgallery/js/blueimp-gallery.js" type="text/javascript"></script>
    
    <script>
        document.getElementById('links').onclick = function (event) {
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {
                    index: link,
                    startSlideshow: true,
                    slideshowInterval: 3000,
                    transitionSpeed: 400,
                    event: event
                },
                links = this.getElementsByTagName('a');
            blueimp.Gallery(links, options);
        };
        blueimp.Gallery(
            document.getElementById('links'),
            {
                onslide: function (index, slide) {
                    var text = this.list[index].getAttribute('data-description'),
                        node = this.container.find('.description');
                    node.empty();
                    if (text) {
                        node[0].appendChild(document.createTextNode(text));
                    }
                }
            }
        );
    </script>
<{/if}> 

<{if $slideshowtype == 'inline'}>

    <!-- The Gallery as inline carousel, can be positioned anywhere on the page -->
    <div id="blueimp-gallery-carousel" class="blueimp-gallery blueimp-gallery-carousel">
        <div class="slides"></div>
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
    </div>
    
    <{if $images_nb > 0}>
        <div id="links" class='hidden'>
            <{foreach item=image from=$images}>
                <a href="<{$wggallery_upload_url}>/images/<{$source}>/<{$image.name}>" title="<{$image.title}>"></a>
            <{/foreach}>
        </div>
    <{/if}>


    <script src="<{$wggallery_url}>/assets/galleries/blueimpgallery/js/blueimp-gallery.js" type="text/javascript"></script>
    
    <script>
        blueimp.Gallery(
        document.getElementById('links').getElementsByTagName('a'),
        {
            container: '#blueimp-gallery-carousel',
            carousel: true,
            startSlideshow: true
        }
    );
    </script>
<{/if}> 
	
<div class="clear spacer"></div>

<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}> 

<!-- Footer -->
<{include file='db:wggallery_admin_footer.tpl'}>