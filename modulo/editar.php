<?php include 'template/header.php'?>

<?php
    if(!isset($_GET['codigo'])){
        header('Location: index.php?mensaje=error');
        exit();
    }
    
    include_once 'model/conexion.php';
    $codigo = $_GET['codigo'];
    
    $sentencia = $bd->prepare("select * from empleado where codigo = ?;");
    $sentencia->execute([$codigo]);
    $empleado = $sentencia->fetch(PDO::FETCH_OBJ);
    //print_r($empleado)
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Editar Datos:
                </div>
                <form class="p-4" method="POST" action="editarProceso.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" autofocus value="<?php echo $empleado->nombre?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Edad: </label>
                        <input type="number" class="form-control" name="txtEdad" autofocus value="<?php echo $empleado->edad?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Signo: </label>
                        <input type="text" class="form-control" name="txtSigno" autofocus value="<?php echo $empleado->signo?>">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?php echo $empleado->codigo?>">
                        <input type="submit" class="btn btn-primary mb-3">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
      
<?php include 'template/footer.php'?>