<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Guemil</title>
<meta name="robots" content="noindex">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
$json = file_get_contents('data.json');
$json_data = json_decode($json,true);
?>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-sm-12">
<header>
<h1>Esta es una prueba<br />
<small>Estoy leyendo el <a href="data.json">data.json</a> con PHP</small></h1>
<h3>Este es el resumen de la evaluación de <?php echo(count($json_data['test']['pictogramas']));?> pictogramas.</h3>
</header>
</div>

<?php for ($a = 0; $a < $all = count($json_data['test']['pictogramas']); $a++) {?>

<!--Felipe Vilches: Aqui empiezo a editar! Agrego un for que pase por las respuestas, para contar cada puntaje con varios if-->
   <?php 
   $q1=0; 
   $q2=0; 
   $q3=0; 
   $q4=0; 
   $q5=0; 
   $q6=0; 
   ?>
  <?php for ($c = 0; $c < $all = count($json_data['test']['pictogramas'][$a]['respuestas']); $c++) {?>
           <?php 
          if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "1"){
            $q1++;
             }
          if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "2"){
            $q2++;
             }
          if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "3"){
            $q3++;
             }
          if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "4"){
            $q4++;
             }
          if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "5"){
            $q5++;
             }
          if (($json_data['test']['pictogramas'][$a]['respuestas'][$c]['puntaje']) == "6"){
            $q6++;
             }   
          $desempeno= ($q1+$q2*0.75+$q3*0.5)*100/($q1+$q2+$q3+$q4+$q5+$q6);

 };?> <!--cierre el for con $c-->


<div class="col-sm-6 col-md-4 col-lg-3">
<article>
<h3><?php echo($json_data['test']['pictogramas'][$a]['nombre']);?></h3>
<h4>Tenemos <?echo (count($json_data['test']['pictogramas'][$a]['respuestas']))?> respuestas.</h4>
<img class="picto" src="<?php echo($json_data['test']['pictogramas'][$a]['imagen']);?>" />
<h4>Efectividad del <code><?php echo (round($desempeno));?></code>%</h4>
<h5>Desglose</h5>
<p>Correcta: <code> <?php echo ($q1);?> </code></p>
<p>Casi Correcta: <code> <?php echo ($q2);?> </code></p>
<p>Dudosa: <code> <?php echo ($q3);?> </code></p>
<p>Inorrecta: <code> <?php echo ($q4);?> </code></p>
<p>Significado Opuesto: <code> <?php echo ($q5);?> </code></p>
<p>Sin Respuesta: <code> <?php echo ($q6);?> </code></p>
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#<?php echo($json_data['test']['pictogramas'][$a]['nombre']);?>">Ver respuestas</button>

<!-- Modal -->
<div class="modal fade" id="<?php echo($json_data['test']['pictogramas'][$a]['nombre']);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo($json_data['test']['pictogramas'][$a]['nombre']);?></h4>
      </div>
      <div class="modal-body">
      <ol>
        <?php for ($b = 0; $b < $todarespuesta = count($json_data['test']['pictogramas'][$a]['respuestas']); $b++) {?>
          <li><?php echo($json_data['test']['pictogramas'][$a]['respuestas'][$b]['responde']);?></li>
        <?php };?><!--cierre el for con $b-->
      </ol>
      </div>
    </div>
  </div>
</div>
<!--cierra el modal-->
</article>
</div><!--/col-sm-4-->
<?php };?><!--cierre el for con $a-->

<div class="clearfix"></div>
<div class="col-sm-12">
<footer>
<pre>
<code>
<?php print_r($json_data);?>
</code>
</pre>
</footer>
</div>
</div><!--/row-->
</div><!--/container-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
