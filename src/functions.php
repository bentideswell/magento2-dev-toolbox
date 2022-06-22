<?php
/**
 *
 */
namespace FishPig\DevToolbox;

function debug_backtrace() {
    $debugArgs = function($args, $level = 1) use (&$debugArgs) {        
        $indent = str_repeat('&nbsp;', $level*4);
        foreach ($args as $key => $value) {
            echo $indent . $key . ' =&gt; ';

            if (is_object($value)) {
                echo get_class($value);
            } elseif (is_array($value)) {
                echo 'Array(';
                
                ob_start();
                $debugArgs($value, $level+1);
                if ($value = ob_get_clean()) {
                    echo '<br/>' . $value . '<br/>' . $indent;
                }
                echo ')';
            } else {
                echo $value;
            }
            
            echo '<br/>';
        }

    };
    
    foreach (array_slice(\debug_backtrace(), 1) as $x) {
        echo '<strong>' . $x['line'] . ': ' . str_replace(BP, '', $x['file']) . '</strong><br/>';        
        
        if (isset($x['class'])) {
            echo $x['class'] . $x['type'];
        }

        echo $x['function'] . '(';

        if ($x['args']) {
            echo '<br/>';
            $debugArgs($x['args']);
        }
        
        echo ');<br/><br/>';
    }
}
