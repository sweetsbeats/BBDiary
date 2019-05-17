<?php
/* BBDiary: A girl's diary on one page
 * Prettyboy-yumi */

/* CONFIG_BBDIARY_HOMEPAGE
 * A URL to this diary */
define("CONFIG_BBDIARY_HOMEPAGE", "https://sweetsbeats.herokuapp.com/");
/* CONFIG_DIARY_FSPATH
 * The directory you will be serving */
define("CONFIG_DIARY_FSPATH", "/app/posts/");
/* CONFIG_APACHE2_XSENDFILE
 * Enable this if you are running Apache with XSendfile */
define("CONFIG_APACHE2_XSENDFILE", false);
/* CONFIG_NGINX_XSENDFILE
 * Enable this if you are running nginx with XSendfile */
define("CONFIG_NGINX_XSENDFILE", false);
/* CONFIG_LIGHTTPD_XSENDFILE
 * Enable this if you are running lighttpd with XSendfile */
define("CONFIG_LIGHTTPD_XSENDFILE", false);
/* CONFIG_CLEAN_URL
 * Enable only if you have followed the Clean URL steps laid
 * out in the README */
define("CONFIG_CLEAN_URL", false);

/*******************************************************
* You probably don't need to touch anything below here *
* unless you are contributing                          *
* of course                            ~Prettyboy-yumi *
*******************************************************/

// Current working directory
$relpath = urldecode($_GET['path']) ?: '/';
$abspath = realpath(CONFIG_DIARY_FSPATH . $relpath);
if (is_dir($abspath)) $abspath .= '/';

// Error handling
if (!$abspath) {
	$errresponse = "$_SERVER[SERVER_PROTOCOL] 404 Not Found";
	header($errresponse);
}
else if (strpos($abspath, CONFIG_DIARY_FSPATH) === false) {
	$errresponse = "$_SERVER[SERVER_PROTOCOL] 403 Forbidden";
	header($errresponse);
}
else if (!is_readable($abspath)) {
	$errresponse = "$_SERVER[SERVER_PROTOCOL] 403 Forbidden";
	header($errresponse);
}
else if (is_file($abspath)) {
	$mtype = mime_content_type($abspath);
	if (explode('/', $mtype)[0] != 'text') {
		$fsize = filesize($abspath);
		header("Content-Type: $mtype");
		header("Content-Length: $fsize");
		if (CONFIG_LIGHTTPD_XSENDFILE)
			header("X-LIGHTTPD-send-file: $abspath");
		else if (CONFIG_APACHE2_XSENDFILE)
			header("X-Sendfile: $abspath");
		else if (CONFIG_NGINX_XSENDFILE)
			header("X-Accel-Redirect: $abspath");
		else
			readfile($abspath);
		die;
	}
} ?>
<!DOCTYPE HTML>
<HTML>
<head>
	<title>Dev blog</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- BBDiary Favicon -->
	<link href="data:image/ico;base64,AAABAAEAEBAQAAAAAAAoAQAAFgAAACgAAAAQA
	AAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAD/ScwAAAAAAP8AAAD///8AAAAA
	AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAERERERERERE
	SIiIiIiIiITMjIyMjIyIxEyMjMyMyIjETIyMjIyMiMRMjIyMjIyMjMiMjMyMzIyMSIiIiIi
	IiIRAAAAAAAAABEzMzADMzMAETMAMwMwAzARMzMzAzMzMBEzADMDMAMwETMzMAMzMwARAAA
	AAAAAABEREREREREREAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
	AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel=icon type="image/x-icon">
	<style>
	/* Main Layout */
		body { background-color: aliceblue; color: black;
			/* Starry background */
			background-image: url("background.jpg");
			background-repeat: repeat;
			background-attachment: fixed;
			background-size: 100%;

			font-family:"ヒラギノ角ゴ Pro W3",
			"Hiragino Kaku Gothic Pro",
			Osaka,
			"メイリオ",
			Meiryo,
			"ＭＳ Ｐゴシック",
			"MS PGothic",
			sans-serif;
		}
		h1 { font-family: "Palatino Linotype",
			"Book Antiqua",
			Palatino,
			serif;
			font-weight: lighter; }
		h1 a, h2 a, h3 a { text-decoration: none; }
	/* Reader */
		main { max-width: 40em;
			margin: auto;
			padding: 10px;
			background: white;
			border: 3px double;
			border-radius: 5px; }
		ol, ul { display: flex;
			flex-wrap: wrap;
			justify-content: center;
			list-style-type: none;
			white-space: nowrap;
			list-style-type: none;
			padding: 0; }
		li { margin: 15px; }
		li a { padding-left: 5px;
			padding-right: 5px;
			transition: box-shadow 0.5s, color 1s;
			border: 1px solid;
			text-decoration: none;
			cursor: pointer; }
		.hoverbox { transition: box-shadow 0.5s, color 1s; }
		.hoverbox:hover { box-shadow: -3px 3px 10px; }
		article { text-align: justify; }
		header { text-align: center; }
		footer { text-align: center; margin: auto; }
	/* Link styling */
		a, a:visited { outline: none; color: inherit; }
		a:hover { text-decoration: none; }
	/* Navigation bar */
		nav a { border-top: 1px solid;
			border-bottom: 1px solid;
			border-right: 1px solid;
			padding-right: 8px;
			padding-left: 8px;
			text-decoration: none; }
		nav a:first-child { border-left: 1px solid; }

		.about { max-width: 20em;
				
					display:flex;
					justify-content:center;
					align-items: center;

		}
		.aboutContainer{ padding-left: 5px;
						 display:flex;
					     justify-content:center;
						 align-items:flex-end;}
		.aboutIMG { /*padding-right: 8em;*/
					border-radius:10px;
					border:2px solid;
					
		}
		.aboutText {padding-left:8px;
					font-size: 19px;
					/*text-decoration: none;*/
					font-weight: 100}
		.aboutTT {padding-left:10px;
					font-size: 18px;
					/*text-decoration: none;*/
					font-weight: 100;
					line-height: 2;}

	</style>
</head>
<body><main>
<header>
<h1><a href="<?php print CONFIG_BBDIARY_HOMEPAGE?>">Hello! </a>
	<div class="about">
		<div class="aboutContainer">
		<image src="pfp.png" width="128"height="128" class="aboutIMG">
		</image>
		
		</div>
		<div>
		<div class="aboutText"> Hello, I'm sweets; I make video games and write software.
								I grew up playing on N64/Gamecube, and I'm heavily inspired by Harvest Moon, Animal Crossing, Zelda, etc.
								</div>
		<div class="aboutTT"> Things I love:  &nbsp;Beer, my cats, cold weather, Linux</div>
		</div>
	</div>
</h1>
<nav><?php
		$chunks = explode('/', $relpath);
		if (empty($chunks[count($chunks)-1]))
			// Ignore the empty item for directories
			// (trailing slash)
			array_pop($chunks);
		foreach ($chunks as $n => $chunk) {
			if (!is_file(CONFIG_DIARY_FSPATH
			. urldecode($chunkedpath) . $chunk)
			|| (count($chunks) - $n - 1))
				$chunk .= '/';
			$chunkedpath .= urlencode($chunk);
			$chunkedpath = str_replace("%2F", "/", $chunkedpath);
			if ($chunkedpath == '/')
				$href = CONFIG_BBDIARY_HOMEPAGE;
			else if (CONFIG_CLEAN_URL)
				$href = $chunkedpath;
			else
				$href = "?path=$chunkedpath";

			print <<<HOVERBOX
<a class=hoverbox href="$href">$chunk</a>
HOVERBOX;
		}
?></nav>
</header>
<hr>
<?php
	if ($errresponse) {
		print <<<ERRRESP
	<article>Error: $errresponse</article>

ERRRESP;
	}
	else if (is_file($abspath)) {
		$text = file_get_contents($abspath);
		$text = bbbbbbb($text);
		$text = nl22br($text);
		print <<<RESP
	<article>$text</article>

RESP;
	} else if (is_dir($abspath)) {
		$contents = array_diff(
			scandir($abspath), array('.', '..')
		);
		print <<<UL
	<ul>

UL;
		foreach ($contents as $item) {
			$href = urlencode($relpath) . urlencode($item);
			$href = str_replace("%2F", "/", $href);
			if (CONFIG_CLEAN_URL)
				$href = $href;
			else
				$href = "?path=$href";
			if (is_file($abspath.$item)) {
				print <<<FHREF
		<li><a class=hoverbox href="$href">$item</a></li>

FHREF;
			} else {
				print <<<DHREF
		<li><a class=hoverbox href="$href/">$item</a></li>

DHREF;
			}
		}
		print <<<EOUL
	</ul>

EOUL;
	}
?></main>
</body>
</HTML>
<?php
/*
 * Like strpos but does not loop over the
 * entire string when given an offset
*/
function indexOf($string, $substring, $offset = 0)
{
	$stringlen = strlen($string);
	$sublen = strlen($substring);
	for ($i = $offset, $j = 0; $i < $stringlen; $i++) {
		if ($string{$i} == $substring{$j}) {
			if (!(++$j - $sublen))
			return $i - $sublen + 1;
		} else $j = 0;
	}
	return -1;
}
/*
 * Magical BBCode parse
*/
function bbbbbbb($string)
{
	$opened = []; $contents = [];
	$offset = 0;
	while (($a = indexOf($string, "[", $offset)) >= 0
	&& ($b = indexOf($string, "]", $offset)) > $a) {
		// Push the parsed contents to an array
		$contents[] = substr($string, $offset, $a - $offset);
		$tag = substr($string, $a, $b + 1 - $a);
		$contents[] = $tag;

		// Since we finished scanning the part of the string
		// that is behind the last seen bracket, advance
		// the scanning offset
		$offset = $b + 1;

		// Strip brackets
		$inside = substr($tag, 1, strlen($tag) - 2);

		// Is this a closing or opening tag?
		if ($inside{0} == "/") {
			$tag = substr($inside, 1);
			if (!count($opened[$tag]))
				continue;
			$opening_tag = array_pop($opened[$tag]);
			$from = $opening_tag["index"];
			$param = $opening_tag["param"];
			$to = count($contents) - 1;

			switch($tag) {
			case  'b':
				$open = "<strong>";
				$close = "</strong>";
				break;
			case 'i':
				$open = "<em>";
				$close = "</em>";
				break;
			case 'color':
				$color = htmlspecialchars($param);
				$open = "<span style='color:$color'>";
				$close = "</span>";
				break;
			case 'quote':
				$open = "<blockquote>";
				$close = "</blockquote>";
				break;
			case 'url':
				$url = htmlspecialchars($param);
				$open = "<a href='$url'>";
				$close = "</a>";
				break;
			case 'code':
				$open = "<pre>";
				$close = "</pre>";
				break;
			default: continue;
			}
			$contents[$from] = $open;
			$contents[$to] = $close;
		} else {
			if (($c = indexOf($inside, "=")) > 0) {
				$tag = substr($inside, 0, $c);
				$param = substr($inside, $c + 1);
			} else {
				$tag = $inside;
				unset($param);
			}
			$opened[$tag][] = [
				"index" => count($contents) - 1,
				"param" => $param
			];
		}
	}
	$contents[] = substr($string, $offset);
	return join($contents);
}
function nl22br($string)
{
	return str_replace("\n\n", "<br/><br/>", $string);
}
?>
