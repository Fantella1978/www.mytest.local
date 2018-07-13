<?php

/**
 * Class View
 *
 * @property array $articles
 */
class View
    implements Countable, Iterator, ArrayAccess
{
    protected $data = Array();
	protected $position = 0;

	public function __construct() {
        $this->position = 0;
    }
	
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
		if (isset($this->data[$name])) {
			return $this->data[$name];
		} else {
			return null;
		}
    }

    function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function render($template)
    {
        ob_start();
        foreach ($this->data as $key => $val)
        {
            $$key = $val;
        }
        include __DIR__ . '/../../templates/' . $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function display($template)
    {
        echo $this->render($template);
    }

    public function displayFullWidthContentBegin()
    {
		include_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'parts' . DIRECTORY_SEPARATOR . 'content_begin_full_width.phtml');
    }

    public function displayFullWidthContentEnd()
    {
		include_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'parts' . DIRECTORY_SEPARATOR . 'content_end_full_width.phtml');
    }

    public function displayItemsInFullWidthContent($template)
    {
		$this->displayFullWidthContentBegin();
		foreach ($this->items as $item) {
			$this->item = $item;
			echo $this->render($template);
		}
		$this->displayFullWidthContentEnd();
    }

    public function displayErrorAndDie($errorCode, $errorText)
    {
		$this->errorCode = $errorCode;
		$this->errorText = $errorText;
		$log = new ErrorLogger();
		$log->Add($errorCode . ' ' . $errorText);
		switch ($errorCode) {
			case 403: 
				header('HTTP/1.0 403 Forbidden');
				break;
			case 404: 
				header('HTTP/1.0 404 Not Found');
				break;
			default:
				header('HTTP/1.1 500 Server Error');
		}
        echo $this->render('errors/error.php');
		die;
    }

	public function displayNewsArchiveBtn(){
		$btn = new Btn();
		$btn->tag = 'a';
		$btn->href = '#';
		$btn->class = 'btn btn-primary';
		$btn->role = 'button';
		$btn->text = 'Архив новостей';
		$btn->display();
		return true;
	}
	
    public function count()
    {
        return count($this->data);
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
		if (isset($this->data[$offset])) {
			return $this->data[$offset];
		} else {
			return null;
		}
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
		if (isset($this->data[$offset])) {
			unset($this->data[$offset]);
		}
    }

    public function current()
    {
		if (isset($this->data[$this->position])) {
			return current($this->data[$this->position]);
		} else {
			return null;
		}
    }

    public function next()
    {
        ++$this->position;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return isset($this->array[$this->position]);
    }

    public function rewind()
    {
        $this->position = 0;
    }

}