<?php
##################################################
# Класс КЭШИРОВАНИЯ страниц
##################################################
class PageCache {
	
	public $DataGetFromCache;

	private $cache;
	private $cachefilename;
	private $modif;
	private $fullfilename;
	private $fullfilepath;
	private $md5hash;
	private $cacheoff;
	private $updatecachefile;
	private $timecache;
	private $path;

	#-------------------------
	function __construct($timecache, $path)
    {
		$this->timecache = $timecache;
		$this->path = $path;
	}
	#-------------------------
	public function CacheStart($urlglobal){
		if(isset($_GET['cache']) AND $_GET['cache']=='off'){
			$this->cacheoff=true;
			$this->DataGetFromCache = false;
			$this->CacheInit();
			return;
		} else {
			$this->cacheoff=false;
		}
		if(isset($_GET['cache']) AND $_GET['cache']=='update'){
			$this->updatecachefile=true;
		}else{
			$this->updatecachefile=false;
		}
		$urlglobal = preg_replace('/[\?,\&]cache=(off|update)$/i','',$urlglobal);
		$this->md5hash=md5($urlglobal);
		$this->cachefilename=substr($this->md5hash,2,30);
		$this->fullfilepath=$this->path.substr($this->md5hash,0,1).'/'.substr($this->md5hash,1,1).'/';
		$this->fullfilename=$this->fullfilepath.$this->cachefilename;
		$this->modif=time()-@filemtime($this->fullfilename);
		if($this->modif<$this->timecache AND !$this->updatecachefile){
			if(@include($this->fullfilename)){
				$this->DataGetFromCache = true;
				return;
			}
		}
		$this->DataGetFromCache = false;
		$this->CacheInit();
	}

	#-------------------------
	public function CacheInit() {
		if(isset($this->cacheoff) and $this->cacheoff){return;}
		ob_start();
	}

	#-------------------------
	public function CacheClean() {
		if(isset($this->cacheoff) and $this->cacheoff){return;}
		ob_end_clean();
	}

	#-------------------------
	public function CacheGet() {
		if(isset($this->cacheoff) and $this->cacheoff){return;}
		$this->cache = ob_get_contents();
		return $this->cache;
	}

	#-------------------------
	public function CacheInputAndWrite(){
		if(isset($this->cacheoff) and $this->cacheoff){return;}
		echo $this->cache;
		if(!@file_exists($this->fullfilepath)) { @mkdir($this->fullfilepath,0777,true); }
		$fp=@fopen($this->fullfilename,"w");
		@fwrite ($fp,$this->cache);
		@fclose ($fp);
	}

	#-------------------------
	public function EndCacheInputAndWrite(){
		if(isset($this->cacheoff) and $this->cacheoff){return;}
		if ($this->DataGetFromCache == false) {
			$this->CacheGet();
			$this->CacheClean();
			$this->CacheInputAndWrite();
		}
	}
}
?>