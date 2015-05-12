<?php namespace Clips\Doc\Widgets\Highlightjs; in_array(__FILE__, get_included_files()) or exit("No direct script access allowed");

class Widget extends \Clips\Widget {
    protected function doInit() {
		$js = "hljs.initHighlightingOnLoad();";
        \Clips\context('jquery_init', $js, true);
	}
}
