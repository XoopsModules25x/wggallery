<!-- Header -->
<link href="<{$wggallery_url}>/assets/galleries/pgwslideshow/<{$css_pgwslideshow}>" rel="stylesheet">

<{include file='db:wggallery_admin_header.tpl'}>

  <style>
    .pictures {
      margin: 0;
      padding: 0;
      list-style: none;
      max-width: 100%;
    }

    .pictures > li {
      float: left;
      width: 33.3%;
      height: 33.3%;
      margin: 0 -1px -1px 0;
      border: 1px solid transparent;
      overflow: hidden;
    }

    .pictures > li > img {
      width: 100%;
      cursor: -webkit-zoom-in;
      cursor: zoom-in;
    }

    .viewer-download {
      color: #fff;
      font-family: FontAwesome;
      font-size: .75rem;
      line-height: 1.5rem;
      text-align: center;
    }

    .viewer-download::before {
      content: "\f019";
    }
  </style>
  
<{if $images_nb > 0}>
    <div id="galley">
        <ul class="pictures">
            <{foreach item=image from=$images}>
                <li><img data-original="<{$wggallery_upload_url}>/images/<{$source}>/<{$image.name}>" src="<{$wggallery_upload_url}>/images/<{$source_preview}>/<{$image.name}>" alt="<{$image.title}>"></li>
            <{/foreach}>
        </ul>
    </div>
<{/if}>

<script>
    window.addEventListener('DOMContentLoaded', function () {
      var galley = document.getElementById('galley');
      var viewer = new Viewer(galley, {
        url: 'data-original',
        inline: false,
        button: <{$button_close}>,
        navbar: <{$navbar}>,
        title: <{$title}>,
        fullscreen: <{$fullscreen}>,
        zoomable: <{$zoomable}>,
        <{if $toolbar}>toolbar: {
          oneToOne: true,
          zoomIn: true,
          zoomOut: true,
          prev: function() {
            viewer.prev(true);
          },
          play: true,
          next: function() {
            viewer.next(true);
          },
          <{if $download}>download: function() {
            const a = document.createElement('a');

            a.href = viewer.image.src;
            a.download = viewer.image.alt;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
          },<{else}>download: false,<{/if}>
        },<{else}>toolbar: false,<{/if}>
      });
    });
</script>

<div class="clear spacer"></div>

<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>

<!-- Footer -->
<{include file='db:wggallery_admin_footer.tpl'}>
