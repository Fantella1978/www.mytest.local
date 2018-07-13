<?php

class NewsView
	extends View
{
	public $isVisibleArchiveBtn = false;
	public $isVisibleNextNewsBtn = false;
	public $isVisiblePreviousNewsBtn = false;
	public $isVisibleAddNewsBtn = false;
	
	public function renderIndexButtons(){
        ob_start();

		?>
		<div class="row">
			<?php
			if ($this->isVisibleAddNewsBtn === true) {
			?>
			<div class="col-sm">
				<?php $this->displayAddNewsBtn(); ?>
			</div>
			<?php
			}
			?>
			<?php
			if ($this->isVisibleArchiveBtn === true) {
			?>
			<div class="col-sm">
				<?php $this->displayNewsArchiveBtn(); ?>
			</div>
			<?php
			}
			?>
		</div>
		<?php
		
        $content = ob_get_contents();
        ob_end_clean();
        return $content;		
	}
	
	public function displayIndexButtons()
	{
		echo $this->renderIndexButtons();
	}

	public function displayIndexButtonsBlock(){
		
		echo $this->renderIndexButtons();		
	}
	
	public function displayNewsArchiveBtn(){
		$btn = new Btn();
		$btn->tag = 'a';
		$btn->href = '#';
		$btn->class = 'btn btn-primary';
		$btn->role = 'button';
		$btn->text = 'Архив новостей';
		$btn->display();
	}
		
	public function displayAddNewsBtn(){
		$btn = new Btn();
		$btn->tag = 'a';
		$btn->href = '#';
		$btn->class = 'btn btn-primary';
		$btn->role = 'button';
		$btn->text = 'Добавить новость';
		$btn->display();
	}
	
}
?>