<?php

	/**
	 * This is class CGallery
	 *
	 */	
	class CGallery {
		private $validImages=array("jpg", "jpeg", "png", "gif");
		private $nrDir=null;
		private $nrImage=null;
		
		public function __construct($options=array()) {
			$this->options=$options;
			$this->path=realpath(ANASSA_GALLERY_PATH.DIRECTORY_SEPARATOR.$this->options["path"]);
			$this->imgSize=$this->options["size"];
		}
		
		public function htmlGallery() {
			if (substr_compare(ANASSA_GALLERY_PATH, $this->path, 0, strlen(ANASSA_GALLERY_PATH))>=0) {
				$htmlCrumb=$this->createBreadcrumb();
				$html="";
				if (is_dir($this->path)) {
					$html.=$this->readItemsInDir();
				} elseif (is_file($this->path)) {
					$html.=$this->readItem();
				}
				$html=$htmlCrumb."<span class='font-small-italic'>".($this->nrDir>0 ? "Kataloger: ".$this->nrDir."<br/>" : "").($this->nrImage>0 ? "Bilder: ".$this->nrImage."<br/>" : "")."</span>".$html;
			} else {
				$html="Otillåten sökväg!<br/>".$this->path."<br/>".
					substr_compare(ANASSA_GALLERY_PATH, $this->path, 0, strlen(ANASSA_GALLERY_PATH));
			}
			return $html;
		}

		private function createBreadcrumb() {
			$parts=explode(DIRECTORY_SEPARATOR, trim(substr($this->path, strlen(ANASSA_GALLERY_PATH)+1), DIRECTORY_SEPARATOR));
			$html="
<ul class='breadcrumb'>
	<li>
		<a href='?'>Start</a>".(empty($parts[0]) ? " »" : "")."
	</li>";
			if (!empty($parts[0])) {
				$path=null;
				foreach ($parts as $part) {
					$path.=($path ? DIRECTORY_SEPARATOR : "").$part;
					$html.="
	<li>
		» <a href='?path=".$path."'>".$part."</a>
	</li>";
				}
			}
			$html.="
</ul>";
			return $html;
		}
		
		private function imgPhp($href, $width, $height, $alt, $option) {
			$opt="";
			if ($this->options["quality"]>=0) {
				$opt.="&amp;quality=".$this->options["quality"];
			}
			if ($this->options["ignoreCache"]) {
				$opt.="&amp;no-cache=true";
			}
			if ($this->options["cropToFit"]) {
				$opt.="&amp;crop-to-fit=true";
			}
			if ($this->options["sharpen"]) {
				$opt.="&amp;sharpen=true";
			}
			if ($this->options["grayScale"]) {
				$opt.="&amp;gray-scale=true";
			}
			if ($this->options["emboss"]) {
				$opt.="&amp;emboss=true";
			}
			for ($i=1; $i<=3; $i++) {
				if ($this->options["colorize_".$i]) {
					$opt.="&amp;colorize-".$i."=".$this->options["colorize_".$i];
				}
			}
			if ($this->options["negate"]) {
				$opt.="&amp;negate=true";
			}
			if ($this->options["sketchy"]) {
				$opt.="&amp;sketchy=true";
			}
			return "<img src='img.php?src=".$href."&amp;width=".$width."&amp;height=".$height.$opt."' alt='".$alt."' title='".$href."'/>";
		}

		private function readItemsInDir() {
			$files=glob($this->path."/*");
			$length=strlen(ANASSA_GALLERY_PATH);
			$html="
<ul class='gallery'>";
			foreach ($files as $file) {
				$href=str_replace("\\", "/", substr($file, $length+1));
				if (CAnassa::fileIsImage($file, $this->validImages)) {
					$item=$this->imgPhp(ANASSA_GALLERY_BASEURL.$href, $this->imgSize, $this->imgSize, $href, true);
					$caption=basename($file);
					$this->nrImage++;
				} elseif (is_dir($file)) {
					$item="<img src='img/folder.png' width='".$this->imgSize."' height='".$this->imgSize."' alt='Katalog'/>";
					$caption=basename($file)."/";
					$this->nrDir++;
				} else {
					continue;
				}
				$fullCaption=$caption;
				$maxLength=(int)($this->imgSize/7);
				if (strlen($caption)>$maxLength) {
					$caption=substr($caption, 0, $maxLength-5)."..".substr($caption, -4);
				}
				$html.="
	<li>
		<a href='?path=".$href."' title='".$fullCaption."'>
			<figure class='figure overview'>".
					$item."
				<figcaption>".$caption."</figcaption>
			</figure>
		</a>
	</li>";
			}
			$html.="
</ul>";
			return $html;
		}
		
		private function readItem() {
			if (CAnassa::fileIsImage($this->path, $this->validImages)) {
				$imgInfo=list($width, $height, $type, $attr)=getimagesize($this->path);
				$mime=$imgInfo["mime"];
				$date=date("Y-m-d H:i:s", filemtime($this->path));
				$fileSize=round(filesize($this->path)/1024);
				$displayWidth=($width>800 ? 800 : $width);
				$displayHeight=($height>600 ? 600 : $height);
				$length=strlen(ANASSA_GALLERY_PATH);
				$href=ANASSA_GALLERY_BASEURL.str_replace("\\", "/", substr($this->path, $length+1));
				$html="
<p>".
					$this->imgPhp($href, $displayWidth, $displayHeight, $href, false)."
</p>
<p>
	Originalstorlek: ".$width." x ".$height." pixlar. ".CAnassa::txtLinkBlank("img.php?src=".$href.($this->options["ignoreCache"] ? "&amp;no-cache=true" : ""), "Titta på originalet")."<br/>
	Filstorlek: ".$fileSize." kb<br/>
	Mime-typ: ".$mime."<br/>
	Senast ändrad: ".CAnassa::txtDate($date, 3, "min")."
</p>";
			} else {
				$html="
<p>".
					CAnassa::txtMessage("-Detta är ingen giltig bild för galleriet")."<br/>
	Bild: ".$this->path."
</p>";
			}
			return $html;
		}
		
	}
	
?>