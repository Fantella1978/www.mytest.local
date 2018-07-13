<?php

class Btn
{
	public $tag = 'a';
	public $href = '#';
	public $class = '';
	public $type = '';
	public $role = 'button';
	public $text = '';
	
	public function render(){
        ob_start();

		echo '<';
		switch ($this->tag) {
			case 'a':
				echo 'a';
				break;
			case 'button':
				echo 'button';
				break;
			case 'input':
				echo 'input';
				break;		
			default:
				echo 'button';
		}
		echo ' ';
		if (isset($this->class) AND !empty($this->class)) {
			echo 'class="' . $this->class . '" ';
		}
		if (isset($this->href) AND !empty($this->href)) {
			echo 'href="' . $this->href . '" ';
		}
		if (isset($this->role) AND !empty($this->role)) {
			echo 'role="' . $this->role . '" ';
		}
		switch ($this->tag) {
			case 'a':
			case 'button':
				echo '>';
				if (isset($this->text) AND !empty($this->text)) {
					echo $this->text;
				}
				break;
			case 'input':
				if (isset($this->text) AND !empty($this->text)) {
					echo 'value="' . $this->text . '"';
				}
				break;
			default:
				echo '>';
		}
		switch ($this->tag) {
			case 'a':
				echo '</a';
				break;
			case 'button':
				echo '</button';
				break;
			case 'input':
				break;		
			default:
				echo 'button';
		}		
		echo '>';
		
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
	}

	public function display(){
		echo $this->render();
	}
	
	
}
?>