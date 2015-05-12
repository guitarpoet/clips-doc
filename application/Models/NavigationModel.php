<?php namespace Clips\Doc\Models; in_array(__FILE__, get_included_files()) or exit("No direct script access allowed");

use Clips\Model;
use Clips\Interfaces\Initializable;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Clips\SimpleAction;
	

/**
 * This is the model to generate the navigation from the directory structure of document.
 *
 * @author Jack
 * @version 1.0
 * @date Thu Apr 30 12:22:40 2015
 *
 * @Clips\Model
 * @Clips\Library({"repository", "fileCache"})
 */
class NavigationModel extends Model implements LoggerAwareInterface, Initializable {

	public function init() {
		$repo = \Clips\config('repository');
		if(!$repo) {
			throw new \Exception('No repository configured!');
		}

		$repo = $repo[0];
		if(!file_exists($repo)) {
			throw new \Exception('Repository ['.$repo.'] not exists!');
		}

		$ite= new \RecursiveCallbackFilterIterator(new \RecursiveDirectoryIterator($repo, \FilesystemIterator::FOLLOW_SYMLINKS), function ($current, $key, $iterator) {
			if (strpos($current->getFilename(), '.git') !== false) {
				return false;
			}
			if ($current->getFilename() == '..') {
				return false;
			}
			return true;
		});

		$data = array();
		$actionStack = array();

		foreach (new \RecursiveIteratorIterator($ite) as $filename => $cur) {
			if($cur->isDir()) {
				$name = substr($cur->getPath(), strpos($cur->getPath(), $repo) + strlen($repo) + 1);
				if ($cur->getPath() == $repo) { // Skip the root directory
					continue;
				}

				$meta = \Clips\path_join($cur->getPath(), '__meta__.json'); // Try get the metadata from the __meta__.json file
				if(file_exists($meta)) {
					$currentAction = (array) \Clips\parse_json(file_get_contents($meta));
					$currentAction['content'] = $name;
					$currentAction['children'] = array();
					$currentAction['path'] = $cur->getPathname();
				}
				else
					$currentAction = array('label' => $name, 'type' => 'server', 'content' => $name, 'children' => array(), 'path' => $cur->getPathname());

				if($actionStack) {
					$action = array_pop($actionStack);
					if(dirname($currentAction['path'] == $action['path'])) {
						$action['children'] []= $currentAction;
						$actionStack []= $action;
					}
					else {
						if($actionStack) {
							$action = array_pop($actionStack);
						}
						$data []= $action;
					}

				}
				$actionStack []= $currentAction;
			}
			else {
				if($cur->getPath() == realpath($repo))
					continue;
				if($actionStack) {
					if($cur->getExtension() != 'md') // We only want md file
						continue;
					$uri = substr($filename, strpos($filename, $repo) + strlen($repo) + 1);
					$uri = 'doc/show/'.substr($uri, 0, strlen($uri) - 3); // Strip the .md extension
					$name = $cur->getFileName();
					$name = substr($name, 0, strlen($name) - 3);
					$actionStack[count($actionStack) - 1]['children'] []= array('label' => $name, 'type' => 'server', 'content' => $uri);
				}
			}
		}

		while($actionStack) {
			$action = array_pop($actionStack);
		}
		$data []= $action;

		$this->_action = new SimpleAction(array('children' => $data));
	}

	public function actions() {
		return $this->_action->children();
	}

	public function setLogger(LoggerInterface $logger) {
		$this->logger = $logger;
	}
}
