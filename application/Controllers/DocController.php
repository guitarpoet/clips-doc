<?php namespace Clips\Doc\Controllers; in_array(__FILE__, get_included_files()) or exit("No direct script access allowed");

use Clips\Controller;

/**
 * The controller to show the document.
 *
 * @author Jack
 * @version 1.0
 * @date Mon Apr 27 15:19:17 2015
 *
 * @Clips\Widget({"html", "grid", "scaffold", "markup"})
 */
class DocController extends Controller {

	/**
	 * @Clips\Library("repository")
	 */
	public function show($navi = '', $subnavi = '') {
		$repo = \Clips\config('repository');
		if(!$repo) {
			throw new \Exception('No repository configured!');
		}

		$repo = $repo[0];
		if(!file_exists($repo)) {
			throw new \Exception('Repository ['.$repo.'] not exists!');
		}
		$this->repo = $this->repository->repo($repo);
		$content = $this->repo->show(\Clips\path_join($navi, $subnavi).'.md');
		if(!$content)
			$content = $this->repo->show('Readme.md');
		return $this->render('doc', array('content' => $content));
	}
}
