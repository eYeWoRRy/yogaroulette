<?php

function debugStart (){
	echo '<blockquote style="border:1px dotted red; border-left:10px solid red; padding-left:1em;">';
    echo "Kontrollausgabe: ";
    echo "<pre><b>";

}

function debugEnd (){

	echo "</blockquote>";
}

function decho ( $variable, $zeilennummer = "", $dateiname = "" )
{
    global $$variable;
   
    echo "<b>";
    if ( $$variable != "" )
    {
        echo '$'. $variable  .' = ';
        print_r ( $$variable );
    }
    else
    {
        print_r ( $variable );
    }
    echo "</b>";
    // if ( $zeilennummer OR $dateiname )
    // {
    //     echo "&nbsp; &nbsp;- <small>(Zeile: $zeilennummer - $dateiname)</small>";
    // }
    echo '<br>';
    
}

function debugger () {

	$numArgs = func_num_args();
    $arg_list = func_get_args();
    
    debugStart();

    for ($i = 0; $i < $numArgs; $i++) {
        decho ($arg_list[$i], __LINE__, __FILE__ );
    }

    debugEnd();

}

?>