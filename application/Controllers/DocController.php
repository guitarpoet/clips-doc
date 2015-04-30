<?php namespace Clips\Doc\Controllers; in_array(__FILE__, get_included_files()) or exit("No direct script access allowed");

use Clips\Controller;

/**
 * The controller to show the document.
 *
 * @author Jack
 * @version 1.0
 * @date Mon Apr 27 15:19:17 2015
 *
 * @Clips\Widget({"html", "grid", "scaffold", "markup", "navigation"})
 * @Clips\Model({"doc", "navigation"})
 */
class DocController extends Controller {

	/**
	 * @Clips\Library("repository")
	 */
	public function show() {
		return $this->render('doc', array('content' => $this->doc->show(func_get_args()),
		'actions' => $this->navigation->actions()));
	}
}
