<?php
$lang = pll_current_language();
$lang_suffix = array(
  'en' => 'global',
  'tw' => 'tw',
  'hk' => 'hk'
);

echo do_blocks('<!-- wp:template-part {"slug":"footer' . '-' . $lang_suffix[$lang] . '","area":"footer"} /-->');