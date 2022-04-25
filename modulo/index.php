<?php include 'template/header.php'?>

<?php
  include_once "model/conexion.php";
  $sentencia = $bd -> query("select * from empleado");
  $empleado = $sentencia->fetchAll(PDO::FETCH_OBJ);
  //print_r($empleado);
  session_start();
    $usuario = $_SESSION['username'];
    if(!isset($usuario)){
        header("location: ../login.php");
    }else{
?>  
  
<div class="container mt-5">
  <div class="titulo_usuario">
  <?php
          echo "<h1>Bienvenido <b>$usuario</b></h1>";
      }
  ?>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-7">
      <div>
        <ul class="nav nav-tabs mb-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../model/salir.php">Cerrar Sesion</a>
          </li>
        </ul>
      </div>
    <!-- INICIO ALERTA -->
    <?php 
      if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
    ?>
    <div class="alert alert-danger" role="alert">
      <strong>No es posible realizar esa accion!</strong> Hay campos sin rellenar..
    </div>
    <?php
      }
    ?>
    
    <?php 
      if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
    ?>
    <div class="alert alert-success" role="alert">
      <strong>Registrado!</strong> El empleado se ha registrado correctamente..
    </div>
    <?php
      }
    ?>
    
    <?php 
      if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
    ?>
    <div class="alert alert-danger" role="alert">
      <strong>Error!</strong> El proceso no se ha realizado correctamente, vuelva a intentar..
    </div>
    <?php
      }
    ?>
    
    <?php 
      if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
    ?>
    <div class="alert alert-success" role="alert">
      <strong>Editado!</strong> El empleado se ha editado satisfactoriamente
    </div>
    <?php
      }
    ?>
    
    <?php 
      if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
    ?>
    <div class="alert alert-success" role="alert">
      <strong>Eliminado!</strong> El empleado se ha eliminado satisfactoriamente
    </div>
    <?php
      }
    ?>

    <!-- FIN ALERTA -->
      
      <div class="card">
        <div class="card-header">
          Lista de personas
        </div>
        <div class="p-4">
          <table class="table table-dark table-sm align-middle">
          <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Edad</th>
                <th scope="col">Signo</th>
                <th scope="col" colspan="2">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($empleado as $dato){
              ?>
              <tr>
                <td scope="row"><?php echo $dato->codigo;?></td>
                <td><?php echo $dato->nombre;?></td>
                <td><?php echo $dato->edad;?></td>
                <td><?php echo $dato->signo;?></td>
                <td><a href="editar.php?codigo=<?php echo $dato->codigo;?>" style="text-decoration: none;color:white;"><i class="bi bi-pencil-square"></i></a></td>
                <td><a onclick="return confirm('Esta seguro que desea eliminar al empleado?')" href="eliminar.php?codigo=<?php echo $dato->codigo;?>" style="text-decoration: none;color:white;"><i class="bi bi-trash3"></i></a></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
     </div>
    <div class="col-md-4">
       <div class="card">
         <div class="card-header">
           Ingresar Datos:
          </div>
         <form class="p-4" method="POST" action="registrar.php">
            <div class="mb-3">
              <label class="form-label">Nombre: </label>
              <input type="text" class="form-control" name="txtNombre" autofocus>
            </div>
            <div class="mb-3">
              <label class="form-label">Edad: </label>
              <input type="number" class="form-control" name="txtEdad" autofocus>
            </div>
            <div class="mb-3">
              <label class="form-label">Signo: </label>
              <input type="text" class="form-control" name="txtSigno" autofocus>
            </div>
            <div class="d-grid">
              <input type="hidden" name="oculto" value="1">
              <input type="submit" class="btn btn-primary mb-3">
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

<?php include 'template/footer.php'?>

   