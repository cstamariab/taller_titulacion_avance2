<?php
include '../controlador/mantenedor.php';
if(empty ($_POST['campos'])){
    
}else{
    if (is_array($_POST['campos'])) {
        $selected = '';
        $num_selecciones = count($_POST['campos']);
        $current = 0;
        foreach ($_POST['campos'] as $key => $value) {
            if ($current != $num_selecciones-1)
                $selected .= $value.', ';
            else
                $selected .= $value." ";
            $current++;
        }
    }
    
    $mantenedor = new mantenedor();
    $mantenedor->mostrarConsulta($selected);
       
    

}







