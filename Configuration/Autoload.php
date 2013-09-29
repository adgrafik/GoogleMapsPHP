<?php

if (!defined('GMP_VERSION')) die ('Access denied.');

return array(
	'Symfony\\Component\\Yaml\\Yaml' => GMP_PATH . 'Classes/Utility/Yaml/Classes/Yaml.php',
	'Symfony\\Component\\Yaml\\Parser' => GMP_PATH . 'Classes/Utility/Yaml/Classes/Parser.php',
	'Symfony\\Component\\Yaml\\Unescaper' => GMP_PATH . 'Classes/Utility/Yaml/Classes/Unescaper.php',
	'Symfony\\Component\\Yaml\\Inline' => GMP_PATH . 'Classes/Utility/Yaml/Classes/Inline.php',
	'Symfony\\Component\\Yaml\\Escaper' => GMP_PATH . 'Classes/Utility/Yaml/Classes/Escaper.php',
	'Symfony\\Component\\Yaml\\Dumper' => GMP_PATH . 'Classes/Utility/Yaml/Classes/Dumper.php',
	'Symfony\\Component\\Yaml\\Yaml\\Exception\\ExceptionInterface' => GMP_PATH . 'Classes/Utility/Yaml/Classes/Exception/ExceptionInterface.php',
	'Symfony\\Component\\Yaml\\Yaml\\Exception\\ParseException' => GMP_PATH . 'Classes/Utility/Yaml/Classes/Exception/ParseException.php',
	'Symfony\\Component\\Yaml\\Yaml\\Exception\\DumpException' => GMP_PATH . 'Classes/Utility/Yaml/Classes/Exception/DumpException.php',
);

?>