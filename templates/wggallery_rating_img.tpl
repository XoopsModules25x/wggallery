<small>
    <{if $rating_5stars}>
        <div class="wggallery_ratingblock">
            <div id="unit_long<{$image.id}>">
                <div id="unit_ul<{$image.id}>" class="wggallery_unit-rating">
                    <div class="wgwggallery_current-rating" style="width:<{$image.rating.size}>;"><{$image.rating.text}></div>
                    <div>
                        <a class="wggallery_r1-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING1}>" rel="nofollow">1</a>
                    </div>
                    <div>
                        <a class="wggallery_r2-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=2&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING2}>" rel="nofollow">2</a>
                    </div>
                    <div>
                        <a class="wggallery_r3-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=3&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING3}>" rel="nofollow">3</a>
                    </div>
                    <div>
                        <a class="wggallery_r4-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=4&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING4}>" rel="nofollow">4</a>
                    </div>
                    <div>
                        <a class="wggallery_r5-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=5&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING5}>" rel="nofollow">5</a>
                    </div>
                </div>
                <div>
                    <{$image.rating.text}>
                </div>
            </div>
        </div>
    <{/if}>
    <{if $rating_10stars}>
        <div class="wggallery_ratingblock">
            <div id="unit_long<{$image.id}>">
                <div id="unit_ul<{$image.id}>" class="wggallery_unit-rating-10">
                    <div class="wgwggallery_current-rating" style="width:<{$image.rating.size}>;"><{$image.rating.text}></div>
                    <div>
                        <a class="wggallery_r1-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_10_1}>" rel="nofollow">1</a>
                    </div>
                    <div>
                        <a class="wggallery_r2-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=2&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_10_2}>" rel="nofollow">2</a>
                    </div>
                    <div>
                        <a class="wggallery_r3-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=3&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_10_3}>" rel="nofollow">3</a>
                    </div>
                    <div>
                        <a class="wggallery_r4-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=4&amp;source=1" title="<{$smarty.const._MA_WGTIMELINES_RATING_10_4}>" rel="nofollow">4</a>
                    </div>
                    <div>
                        <a class="wggallery_r5-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=5&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_10_5}>" rel="nofollow">5</a>
                    </div>
                    <div>
                        <a class="wggallery_r6-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=6&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_10_6}>" rel="nofollow">6</a>
                    </div>
                    <div>
                        <a class="wggallery_r7-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=7&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_10_7}>" rel="nofollow">7</a>
                    </div>
                    <div>
                        <a class="wggallery_r8-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=8&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_10_8}>" rel="nofollow">8</a>
                    </div>
                    <div>
                        <a class="wggallery_r9-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=9&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_10_9}>" rel="nofollow">9</a>
                    </div>
                    <div>
                        <a class="wggallery_r10-unit rater" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=10&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_10_10}>" rel="nofollow">10</a>
                    </div>
                </div>
                <div>
                    <{$image.rating.text}>
                </div>
            </div>
        </div>
    <{/if}>
<{if $rating_10num}>
        <div class="wggallery_ratingblock">
            <div id="unit_long<{$image.id}>">
                <div id="unit_ul<{$image.id}>" class="wggallery_unit-rating-10numeric">
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=1}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=1&amp;source=1" rel="nofollow">1</a>
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=2}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=2&amp;source=1" rel="nofollow">2</a>
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=3}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=3&amp;source=1" rel="nofollow">3</a>
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=4}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=4&amp;source=1" rel="nofollow">4</a>
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=5}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=5&amp;source=1" rel="nofollow">5</a>
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=6}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=6&amp;source=1" rel="nofollow">6</a>
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=7}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=7&amp;source=1" rel="nofollow">7</a>
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=8}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=8&amp;source=1" rel="nofollow">8</a>
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=9}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=9&amp;source=1" rel="nofollow">9</a>
                    <a class="wggallery-rater-numeric <{if $image.rating.avg_rate_value >=10}>wggallery-rater-numeric-active<{/if}>" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=10&amp;source=1" rel="nofollow">10</a>
                </div>
                <div class='center'>
                    <{$image.rating.text}>
                </div>
            </div>
        </div>
    <{/if}>
    <{if $rating_likes}>
        <div class="wggallery_ratingblock">
            <a class="wgg-rate-like" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=1&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_LIKE}>" rel="nofollow">
                <img class='wgg-btn-icon' src='<{$wggallery_icon_url_24}>like.png' alt='<{$smarty.const._MA_WGGALLERY_RATING_LIKE}>' title='<{$smarty.const._MA_WGGALLERY_RATING_LIKE}>'>(<{$image.rating.likes}>)
            </a>

            <a class="wgg-rate-dislike" href="rate.php?op=<{$save}>&amp;img_id=<{$image.id}>&rating=-1&amp;source=1" title="<{$smarty.const._MA_WGGALLERY_RATING_DISLIKE}>" rel="nofollow">
                <img class='wgg-btn-icon' src='<{$wggallery_icon_url_24}>dislike.png' alt='<{$smarty.const._MA_WGGALLERY_RATING_DISLIKE}>' title='<{$smarty.const._MA_WGGALLERY_RATING_DISLIKE}>'> (<{$image.rating.dislikes}>)
            </a>
        </div>

    <{/if}>
</small>