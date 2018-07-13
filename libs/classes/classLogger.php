<?php

class Logger
{
	protected $path;
	protected $fileName;
	
	public function __construct()
	{
		$this->path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR;
	}
	
	public function Add($line)
	{ # Добавление строки в файл лога
		$line = iconv('utf-8', 'windows-1251', $line);
		$fileExtension = pathinfo($this->fileName, PATHINFO_EXTENSION);
		$fileName = pathinfo($this->fileName, PATHINFO_FILENAME);	
		$LogFileName = $this->path . date("Y-m-d") . '_' .$fileName .   '.' . $fileExtension;
		$LogFileNameOld = $this->path . date("Y-m-d", time()-31*86400) . '_' . $fileName . '.' . $fileExtension;
		if (!@file_exists($this->path)) {
			# Создаём папку если её нет
			@mkdir($this->path,0777,true);
		}
		$file = @fopen($LogFileName, "a"); # Открываем файл для дозаписи
		if(!$file) {
			return false;
		}
		fwrite($file, date("H:i:s") . ' - ' . $line . PHP_EOL);
		fclose($file);
		if(@file_exists($LogFileNameOld)) {
			# Удаляем старый файл если он есть
			@unlink($LogFileNameOld);
		}
		return true;		
	}
}

?>