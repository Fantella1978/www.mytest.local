<?php
class GenerateTime
{
	private $SGT;	# start_generate_time - времени старта

	# ----------------------
	function __construct()
    { // Конструктор, получаем начальное время
		$this->resetGenerateTime();
	}
	public function resetGenerateTime()
	{
		$this->SGT = $this->getTime();
	}

	# ----------------------
	public function getGenerateTime()
	{ // Возвращаем время генерации
		return $this->getTime() - $this->SGT;
	}
	
	# ----------------------
	public function getFormattedGenerateTime()
	{
		return sprintf("%01.3f",$this->getGenerateTime());
	}
	
	# ----------------------
	public function getTime()
	{ // Возвращаем текущее время 
		$mt = microtime();
		// разделяем секунды и миллисекунды (становятся значениями начальных ключей массива-списка)
		$mta = explode(" ",$mt);
		// это и есть время
		return $mta[1] + $mta[0];
	}

}