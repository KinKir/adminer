<?php

class AdminerThemes {
	
	private
		// css themes directory
		$themesDirectory,
		
		// theme destination (adminer)
		$themeDestination,
		
		// keeps current selection record
		$selectionFileName = 'selection.txt';
	
	public
		// list of available themes
		$themesList = [],
		
		// adminer css theme name
		$selectThemeName = 'adminer.css';
	
	
	public function __construct($themesDirectory, $themeDestination) {
		
		$this->themesDirectory = $themesDirectory;
		$this->themeDestination = $themeDestination;
		
		$this->getStylesList();
	}
	
	/**
	 * Gets themes list from styles folder
	 * @return array
	 */
	private function getStylesList() {
		
		$iterator = new DirectoryIterator($this->themesDirectory);
		
		foreach ($iterator as $item)  {
			
			// skip dots
			if ($item->isDot()) {
				continue;
			}
			
			// file name and path
			$fileName = $item->current()->getFilename();
			$filePath = $item->current()->getPathname();
			
			// removing extension
			$fileNameWithoutExtension = str_replace('.css', '', $fileName);
			
			// saving files list
			$this->themesList[$fileNameWithoutExtension] = $filePath;
		}
		
		return $this->themesList;
	}
	
	/**
	 * Copies theme as adminer.css
	 * @param $themeName
	 * @return bool
	 */
	public function selectTheme($themeName) {
		
		// check if theme exists
		if (! array_key_exists($themeName, $this->themesList)) {
			die('Theme not exists in styles folder: '. $this->themesDirectory);
		}
		
		// copy theme
		$source = $this->themesList[$themeName];
		$dest	= $this->themeDestination . $this->selectThemeName;
		
		$cp = copy($source, $dest);
		
		// save selection
		$this->setSelection($themeName);
		
		return $cp;
	}
	
	/**
	 * Writes theme name to text file
	 * @param $themeName
	 * @return false|int
	 */
	private function setSelection($themeName) {
		
		$this->checkFile($this->selectionFileName);
		
		// write to file
		return file_put_contents($this->selectionFileName, $themeName);
	}
	
	/**
	 * Reads theme name from text file
	 * @return false|string
	 */
	public function getSelection() {
		
		$this->checkFile($this->selectionFileName);
		
		// read from file
		return trim(file_get_contents($this->selectionFileName));
	}
	
	/**
	 * Checks for file existence Or creates file
	 * @param $fileName
	 * @return bool
	 */
	private function checkFile($fileName) {
		
		if (!file_exists($fileName)) {
			
			return touch($fileName);
		}
		
		return true;
	}
}
