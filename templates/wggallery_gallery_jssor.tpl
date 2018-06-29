<!-- Header -->

<{include file='db:wggallery_admin_header.tpl'}>

<!-- #region Jssor Slider Begin -->
<!-- Generator: Jssor Slider Maker -->
<!-- Source: https://www.jssor.com -->

<script type="text/javascript">
	jQuery(document).ready(function ($) {

        var jssor_<{$uniqid}>_SlideshowTransitions = [
              {$Duration:400,x:0.25,$Zoom:1.5,$Easing:{$Left:$Jease$.$InWave,$Zoom:$Jease$.$InSine},$Opacity:2,$ZIndex:-10,$Brother:{$Duration:400,x:-0.25,$Zoom:1.5,$Easing:{$Left:$Jease$.$InWave,$Zoom:$Jease$.$InSine},$Opacity:2,$ZIndex:-10}},
              {$Duration:500,x:0.5,$Cols:2,$ChessMode:{$Column:3},$Easing:{$Left:$Jease$.$InOutCubic},$Opacity:2,$Brother:{$Duration:500,$Opacity:2}},
              {$Duration:500,x:0.3,$During:{$Left:[0.6,0.4]},$Easing:{$Left:$Jease$.$InQuad,$Opacity:$Jease$.$Linear},$Opacity:2,$Outside:true,$Brother:{$Duration:000,x:-0.3,$Easing:{$Left:$Jease$.$InQuad,$Opacity:$Jease$.$Linear},$Opacity:2}},
              {$Duration:200,x:0.25,y:0.5,$Rotate:-0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:200,x:-0.1,y:-0.7,$Rotate:0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2}},
              {$Duration:600,x:1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:600,x:-1,$Rows:2,$ChessMode:{$Row:3},$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
              {$Duration:600,y:-1,$Cols:2,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:600,y:1,$Cols:2,$ChessMode:{$Column:12},$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
              {$Duration:200,y:1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:200,y:-1,$Easing:{$Top:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}},
              {$Duration:500,x:-0.1,y:-0.7,$Rotate:0.1,$During:{$Left:[0.6,0.4],$Top:[0.6,0.4],$Rotate:[0.6,0.4]},$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2,$Brother:{$Duration:000,x:0.2,y:0.5,$Rotate:-0.1,$Easing:{$Left:$Jease$.$InQuad,$Top:$Jease$.$InQuad,$Opacity:$Jease$.$Linear,$Rotate:$Jease$.$InQuad},$Opacity:2}},
              {$Duration:600,x:-0.2,$Delay:40,$Cols:12,$During:{$Left:[0.4,0.6]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:260,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Outside:true,$Round:{$Top:0.5},$Brother:{$Duration:000,x:0.2,$Delay:40,$Cols:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Assembly:1028,$Easing:{$Left:$Jease$.$InOutExpo,$Opacity:$Jease$.$InOutQuad},$Opacity:2,$Round:{$Top:0.5}}},
              {$Duration:700,$Opacity:2,$Brother:{$Duration:000,$Opacity:2}},
              {$Duration:200,x:1,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2,$Brother:{$Duration:200,x:-1,$Easing:{$Left:$Jease$.$InOutQuart,$Opacity:$Jease$.$Linear},$Opacity:2}}
            ];
            
		var jssor_<{$uniqid}>_options = {
            $AutoPlay: 1<{$jssor_autoplay}>,                  //0: no auto play, 1: continuously, 2: stop at last slide, 4: stop on click, 8: stop user navigation (click on arrow/bullet/thumbnail, swipe slide, press keyboard left, right arrow key), 12: stop on click or user navigation 
            $AutoPlaySteps: 1,
            $FillMode: 5, 
            $SlideSpacing: 3,
            $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_<{$uniqid}>_SlideshowTransitions,
                $TransitionsOrder: 1
              },
            <{if $arrows}>
                $ArrowNavigatorOptions: {                   //[Optional] Options to specify and enable arrow navigator or not
                    $Class: $JssorArrowNavigator$,          //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                       //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                         //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                               //[Optional] Steps to go for each navigation request, default value is 1
                },
            <{/if}>
            <{if $bullets}>
                $BulletNavigatorOptions: {                  //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,         //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                       //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 1,                         //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                              //[Optional] Steps to go for each navigation request, default value is 1
                    $Rows: 1,                               //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                          //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10,                          //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1                         //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },
            <{/if}>
            <{if $thumbnails}>
                $ThumbnailNavigatorOptions: {               //[Optional] Options to specify and enable thumbnail navigator or not
                    $Class: $JssorThumbnailNavigator$,      //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                       //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $ActionMode: 1,                         //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $SpacingX: 0,                           //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $Cols: 5,                               //[Optional] Number of pieces to display, default value is 1
                    $Align: 400                             //[Optional] The offset position to park thumbnail
                }
            <{/if}>
		};

		var jssor_<{$uniqid}>_slider = new $JssorSlider$("jssor_<{$uniqid}>", jssor_<{$uniqid}>_options);

		/*#region responsive code begin*/

		var MAX_WIDTH = 980;

		function ScaleSlider() {
			var containerElement = jssor_<{$uniqid}>_slider.$Elmt.parentNode;
			var containerWidth = containerElement.clientWidth;

			if (containerWidth) {

				var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

				jssor_<{$uniqid}>_slider.$ScaleWidth(expectedWidth);
			}
			else {
				window.setTimeout(ScaleSlider, 30);
			}
		}

		ScaleSlider();

		$(window).bind("load", ScaleSlider);
		$(window).bind("resize", ScaleSlider);
		$(window).bind("orientationchange", ScaleSlider);
		/*#endregion responsive code end*/
	});
</script>
    <div id="jssor_<{$uniqid}>"
	<{if $jssor_type == 'fullwidth'}>
        style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;"
    <{else}>
        style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;"
    <{/if}> 
    >
        <!-- Loading Screen -->
        <{include file='db:wggallery_gallery_jssor_loadings.tpl' loadings=$loadings}>
		
		<!-- Slides -->
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
			<{if $images_nb > 0}>
				<{foreach item=image from=$images}>
					<div>
						<img data-u="image" src="<{$wggallery_upload_url}>/images/<{$source}>/<{$image.name}>" />
						<{if $thumbnails}>
							<{if $thumbnails == 'thumbnail-091' || $thumbnails == 'thumbnail-092'}>
								<div u="thumb"><{$image.desc}></div>
							<{else}>
								<img data-u="thumb" src="<{$wggallery_upload_url}>/images/thumbs/<{$image.name}>" />
							<{/if}>
						<{/if}>
					</div>
				<{/foreach}>
			<{/if}> 
        </div>
		
        <!-- Bullet Navigator -->
        <{include file='db:wggallery_gallery_jssor_bullets.tpl' bullets=$bullets}>
		
        <!-- Arrow Navigator -->
		<{include file='db:wggallery_gallery_jssor_arrows.tpl' arrows=$arrows}>
		
		<!-- Thumbs Container -->
		<{include file='db:wggallery_gallery_jssor_thumbnails.tpl' thumbnails=$thumbnails}>
    </div>
    <!-- #endregion Jssor Slider End -->

	<!-- Trigger -->
	<script>
		init_jssor_slider1("jssor_<{$uniqid}>");
	</script>

<div class="clear spacer"></div>

<!-- Footer -->
<{include file='db:wggallery_admin_footer.tpl'}>
