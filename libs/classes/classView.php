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