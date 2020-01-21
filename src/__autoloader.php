<?php
spl_autoload_register(function( $class ) {
    if ( 0 !== strpos($class, 'sige\\zhetaoke') ) {
        return;
    }
    $class = explode('\\', $class);
    array_shift($class);
    array_shift($class);
    $path = __DIR__.'/'.implode('/', $class).'.php';
    if ( file_exists($path) ) {
        require $path;
    }
});