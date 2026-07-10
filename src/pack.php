<?php
//This is an alias for faster test print
function p(mixed $mass, bool $ret = false): string|false
{
  $res = "<div style=\"border:1px solid #ff3333; padding:20px; font-size:12px; text-align:left; background:rgba(255,255,255,0.2);\"><pre style=\"word-wrap:break-word; white-space:pre-wrap;\">".str_replace("<", "&lt;", str_replace(">", "&gt;", print_r($mass, true)))."</pre></div>";
  if($ret) return($res);
  print($res);
  return(false);
}

function getFile(string $fname, string $path = "res/"): string
{
  $res = file_get_contents($path.$fname);
  return((string)$res);
}

function makeDataURL(string $fname, string $mime): string
{
  return("data:".$mime.";base64,".base64_encode(getFile($fname)));
}



$html = getFile("index.html","");
$favicon = makeDataURL("favicon.svg","image/svg+xml");
$html = str_replace("href=\"res/favicon.svg\"","href=\"".$favicon."\"",$html);
$css = "";
$css.=getFile("trix.css");
$css.=getFile("g.css");
$css.=getFile("rtf_international.css");
$css.=getFile("rtf_classic.css");
$css.=getFile("rtf_mono.css");
$html = str_replace("<link rel=\"stylesheet\" href=\"res/trix.css\">\n","",$html);
$html = str_replace("<link rel=\"stylesheet\" href=\"res/g.css\">\n","",$html);
$html = str_replace("<link rel=\"stylesheet\" href=\"res/rtf_international.css\">\n","",$html);
$html = str_replace("<link rel=\"stylesheet\" href=\"res/rtf_classic.css\">\n","",$html);
$exxite=makeDataURL("exxite.woff2","font/woff2");
$lilex=makeDataURL("lilex.woff2","font/woff2");
$lilex_italic=makeDataURL("lilex_italic.woff2","font/woff2");
$garamond=makeDataURL("garamond.woff2","font/woff2");
$garamond_italic=makeDataURL("garamond_italic.woff2","font/woff2");
$noto=makeDataURL("noto_sans_display_normal.woff2","font/woff2");
$noto_italic=makeDataURL("noto_sans_display_italic.woff2","font/woff2");
$css=str_replace("url('exxite.woff2')","url(".$exxite.")",$css);
$css=str_replace("url('lilex.woff2')","url(".$lilex.")",$css);
$css=str_replace("url('lilex_italic.woff2')","url(".$lilex_italic.")",$css);
$css=str_replace("url('garamond.woff2')","url(".$garamond.")",$css);
$css=str_replace("url('garamond_italic.woff2')","url(".$garamond_italic.")",$css);
$css=str_replace("url('noto_sans_display_normal.woff2')","url(".$noto.")",$css);
$css=str_replace("url('noto_sans_display_italic.woff2')","url(".$noto_italic.")",$css);
$html = str_replace("<link rel=\"stylesheet\" href=\"res/rtf_mono.css\">\n","<style>".$css."</style>",$html);
$html = str_replace("<script src=\"res/trix.js\"></script>","<script>".getFile("trix.js")."</script>",$html);
p($html);
file_put_contents("../index.html",$html);



?>
