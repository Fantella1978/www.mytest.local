<?php
#
# Наш автозагрузчик классов
#

# --------------------------
function loadFromClasses($aClassName) {

/*    if (0 === strpos($aClassName, 'App\\')) {
        # 'Controllers\Index'
        $path = substr($aClassName, 4);
        require __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $path) . '.php';
		return true;
    }
	return false;
*/

	if (preg_match('/.*Controller$/', $aClassName, $m)) {
		$aClassFilePath = __DIR__ . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $aClassName . '.php';
		if (file_exists($aClassFilePath)) {
			require_once $aClassFilePath;
			return true;
		}		
	}
	if (preg_match('/.*Model$/', $aClassName, $m)) {
		$aClassFilePath = __DIR__ . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . $aClassName . '.php';
		if (file_exists($aClassFilePath)) {
			require_once $aClassFilePath;
			return true;
		}
	}
	if (preg_match('/.*View$/', $aClassName, $m)) {
		$aClassFilePath = __DIR__ . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $aClassName . '.php';
		if (file_exists($aClassFilePath)) {
			require_once $aClassFilePath;
			return true;
		}
	}
	$aClassFilePath = __DIR__ . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'class' . $aClassName . '.php';
	if (file_exists($aClassFilePath)) {
		require_once $aClassFilePath;
		return true;
	}
	return false;
}

spl_autoload_register('loadFromClasses');

?>