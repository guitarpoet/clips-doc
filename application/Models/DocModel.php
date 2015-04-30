<?php namespace Clips\Doc\Models; in_array(__FILE__, get_included_files()) or exit("No direct script access allowed");

use Clips\Model;
use Clips\Interfaces\Initializable;


/**
 * @Clips\Model
 * @Clips\Library("repository")
 */
class DocModel extends Model implements Initializable {
	public function init() {
		$repo = \Clips\config('repository');
		if(!$repo) {
			throw new \Exception('No repository configured!');
		}

		$repo = $repo[0];
		if(!file_exists($repo)) {
			throw new \Exception('Repository ['.$repo.'] not exists!');
		}
		$this->repo = $this->repository->repo($repo);
	}

	public function show($args) {
		$content = $this->repo->show(implode('/', $args).'.md');

		if(!$content)
			$content = $this->repo->show('Readme.md');
		return $content;
	}
}
