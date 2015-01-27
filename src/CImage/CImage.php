<?php
	
	/**
	 * This is class CImage
	 *
	 */	
	class CImage {
		private $src=null;
		private $newWidth=null;
		private $newHeight=null;
		private $quality=80;
		private $ignoreCache=null;
		private $cropToFit=null;
		private $sharpen=null;
		private $grayScale=null;
		private $emboss=null;
		private $colorize_1=0;
		private $colorize_2=0;
		private $colorize_3=0;
		private $negate=null;
		private $sketchy=null;
		
		private $maxWidth=2000;
		private $maxHeight=2000;
		private $pathToImage=null;
		private $imgInfo=null;
		private $imgParts=null;
		private $width=null;
		private $height=null;
		private $image=null;
		private $cacheFileName=null;
		private $validImages=array("jpg", "jpeg", "png", "gif");
		private $saveAs=null;
		
		public function __construct() {
			$this->src=CAnassa::readGet("src", null);
			$this->newWidth=CAnassa::readGet("width", null, "int");
			$this->newHeight=CAnassa::readGet("height", null, "int");
			$this->quality=CAnassa::readGet("quality", 80, "int");
			$this->ignoreCache=CAnassa::readGet("no-cache", null);
			$this->cropToFit=CAnassa::readGet("crop-to-fit", null);
			$this->sharpen=CAnassa::readGet("sharpen", null);
			$this->grayScale=CAnassa::readGet("gray-scale", null);
			$this->emboss=CAnassa::readGet("emboss", null);
			$this->colorize_1=CAnassa::readGet("colorize-1", 0);
			$this->colorize_2=CAnassa::readGet("colorize-2", 0);
			$this->colorize_3=CAnassa::readGet("colorize-3", 0);
			$this->negate=CAnassa::readGet("negate", null);
			$this->sketchy=CAnassa::readGet("sketchy", null);
			$this->pathToImage=realpath(ANASSA_IMG_PATH.$this->src);
			$this->getInfo();
			$this->cacheFileName=$this->checkCache();
		}
		
		public function showImage() {
			if (!isset($_SESSION["message"])) {
				if (!$this->isCached() || $this->ignoreCache) {
					$this->openFile();
					$this->resizeImage();
					$this->doFilters();
					if ($this->ignoreCache) {
						$info=getimagesize($this->pathToImage);
						$mime=$info["mime"];
						header("Content-type: ".$mime);
						$this->saveFile(null);
						exit();
					}
					$this->saveFile($this->cacheFileName);
					$this->outputImage($this->cacheFileName);
				} else {
					$this->outputImage($this->cacheFileName);
				}
			} else {
				$_SESSION["message"]="-".$_SESSION["message"];
			}
		}

		private function outputImage($file) {
			$info=getimagesize($file);
			$mime=$info["mime"];
			$lastModified=filemtime($file);  
			if (isset($_SERVER["HTTP_IF_MODIFIED_SINCE"]) && strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"])==$lastModified) {
				header("HTTP/1.0 304 Not Modified");
			} else {
				header("Content-type: ".$mime);
				readfile($file);
			}
			exit();
		}

		private function getInfo() {
			$this->imgInfo=list($this->width, $this->height, $type, $attr)=getimagesize($this->pathToImage);
			$this->imgParts=pathinfo($this->pathToImage);
			if (empty($this->imgInfo) || !CAnassa::fileIsImage($this->pathToImage, $this->validImages)) {
				CAnassa::addToSession("message", "Filen är inte en giltig bildfil.");
			}
		}

		private function checkCache() {
			$parts=pathinfo($this->pathToImage);
			$ext=$parts["extension"];
			$this->saveAs=is_null($this->saveAs) ? $ext : $this->saveAs;
			$options_=($this->quality>=0 ? "_q".$this->quality : "");
			$options_.=($this->cropToFit ? "_cf" : "");
			$options_.=($this->sharpen ? "_s" : "");
			$options_.=($this->grayScale ? "_gs" : "");
			$options_.=($this->emboss ? "_em" : "");
			$options_.="_col".$this->colorize_1.$this->colorize_2.$this->colorize_3;
			$options_.=($this->negate ? "_neg" : "");
			$options_.=($this->sketchy ? "_sk" : "");
			$dirName=preg_replace("/\//", "-", dirname($this->src));
			$cacheFileName=ANASSA_CACHE_PATH."-".$dirName."-".$parts["filename"].$this->newWidth."_".$this->newHeight.$options_.".".$this->saveAs;
			$cacheFileName=preg_replace("/^a-zA-Z0-9\.-_/", "", $cacheFileName);
			return $cacheFileName;
		}
		
		private function isCached() {
			$imageModifiedTime=filemtime($this->pathToImage);
			$cacheModifiedTime=is_file($this->cacheFileName) ? filemtime($this->cacheFileName) : null;
			if (!$this->ignoreCache && is_file($this->cacheFileName) && $imageModifiedTime<$cacheModifiedTime) {
				return true;
			}
			return false;
		}

		private function resizeImage() {
			$ratio=$this->width/$this->height;
			if ($this->cropToFit && $this->newWidth && $this->newHeight) {
				$newRatio=$this->newWidth/$this->newHeight;
				$cropWidth=$newRatio>$ratio ? $this->width : round($this->height*$newRatio);
				$cropHeight=$newRatio>$ratio ? round($this->width/$newRatio) : $this->height;
			}	elseif ($this->newWidth && !$this->newHeight) {
				$this->newHeight=round($this->newWidth/$ratio);
			}	elseif ($this->newHeight && !$this->newWidth) {
				$this->newWidth=round($this->newHeight*$ratio);
			}	elseif ($this->newWidth && $this->newHeight) {
				$ratio=max($this->width/$this->newWidth, $this->height/$this->newHeight);
				$this->newWidth=round($this->width/$ratio);
				$this->newHeight=round($this->height/$ratio);
			}	else {
				$this->newWidth=$this->width;
				$this->newHeight=$this->height;
			}
			if ($this->cropToFit) {
				$cropX=round(($this->width-$cropWidth)/2);
				$cropY=round(($this->height-$cropHeight)/2);
				$imageResized=$this->keepTransparency($this->newWidth, $this->newHeight);
				imagecopyresampled($imageResized, $this->image, 0, 0, $cropX, $cropY, $this->newWidth, $this->newHeight, $cropWidth, $cropHeight);
			} else {
				$imageResized=$this->keepTransparency($this->newWidth, $this->newHeight);
				imagecopyresampled($imageResized, $this->image, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $this->width, $this->height);
			}
			$this->image=$imageResized;
			$this->width=$this->newWidth;
			$this->height=$this->newHeight;
		}

		private function openFile() {
			$ext=$this->imgParts["extension"];
			switch($ext) {  
				case "jpg":
				case "jpeg": {
					$this->image=imagecreatefromjpeg($this->pathToImage);
					break;
				}
				case "png": {
					$this->image=imagecreatefrompng($this->pathToImage);
					break;
				}
				case "gif": {
					$this->image=imagecreatefromgif($this->pathToImage);
					break;
				}
				default: {
					CAnassa::addToSession("message", "Inget stöd för filändelsen '".$ext."'");
				}
			}
		}

		private function keepTransparency($width, $height) {
			$img=imagecreatetruecolor($width, $height);
			imagealphablending($img, false);
			imagesavealpha($img, true);
			return $img;
		}

		private function saveFile($cacheFile) {
			switch($this->saveAs) {
				case "jpg":
				case "jpeg": {
					imagejpeg($this->image, $cacheFile, $this->quality);
					imagedestroy($this->image);
					break;
				}
				case "png": {
					imagealphablending($this->image, false);
					imagesavealpha($this->image, true);
					imagepng($this->image, $cacheFile);
					imagedestroy($this->image);
					break;
				}
				case "gif": {
					imagegif($this->image, $cacheFile);
					imagedestroy($this->image);
					break;
				}
				default: {
					CAnassa::addToSession("message", "Inget stöd för filändelsen '".$this->saveAs."'");
				}
			}
		}

		private function doFilters() {
			if ($this->sharpen) {
				$matrix=array(
					array(-1, -1, -1),
					array(-1, 16, -1),
					array(-1, -1, -1)
					);
				$divisor=8;
				$offset=0;
				imageconvolution($this->image, $matrix, $divisor, $offset);
			}
			if ($this->emboss) {
				imagefilter($this->image, IMG_FILTER_EMBOSS);
			}
			imagefilter($this->image, IMG_FILTER_COLORIZE, $this->colorize_1, $this->colorize_2, $this->colorize_3);
			if ($this->grayScale) {			
				imagefilter($this->image, IMG_FILTER_GRAYSCALE);
			}
			if ($this->negate) {
				imageFilter($this->image, IMG_FILTER_NEGATE);
			}
			if ($this->sketchy) {
				imageFilter($this->image, IMG_FILTER_MEAN_REMOVAL);
			}
		}
		
	}
	
?>