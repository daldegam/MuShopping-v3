<?php
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: N&atilde;o &eacute; permitido acessar o arquivo diretamente. </strong>");

if(class_exists("LD_Templates") == false) 
{
	class LD_Templates 
	{
	  var $file;
	  var $content_file;
	  var $tags = array();
	  var $tags_count = 0; 
	  
		public function open($file) 
		{
			$this->file = @fopen($file, "r");
			if($this->file == false) exit("Erro: O arquivo ".$file." n&atilde;o foi encontrado.");
			$this->content_file = @fread($this->file, filesize($file));
			if($this->content_file == false) exit("Erro: N&atilde;o foi possivel ler o conteudo do arquivo ".$file);		
		}
		public function set($tag,$value) 
		{
			$this->tags[$this->tags_count++] = array("Name" => $tag, "Value" => $value);
		}
		public function show() 
		{
			for($Count_Sets = 0; $Count_Sets < count($this->tags); $Count_Sets++) 
			{
				$this->content_file = str_replace("{#".$this->tags[$Count_Sets]['Name']."}", $this->tags[$Count_Sets]['Value'], $this->content_file);
			}
			eval("?>".$this->content_file."<?"); 
		}
	}
}

?>