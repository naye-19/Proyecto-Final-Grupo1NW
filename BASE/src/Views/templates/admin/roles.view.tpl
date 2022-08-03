<section class="container-fluid min-vh-100">

  <h3 class="my-4 text-center h1 font-weight-bold">Gestión de Roles Administrativos</h3>
  
  <div class="d-flex-inline">
    <form method="POST" action="index.php?page=admin_roles">
      <div class="form-row">
        <div class="col-8">
          <input type="search" class="form-control" id="UsuarioBusqueda" name="UsuarioBusqueda" value="{{UsuarioBusqueda}}" placeholder="Ingrese su busqueda">
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-success mb-2" id="btnBuscar" name="btnBuscar">Buscar</button>
        </div>
      </div>
    </form> 
  </div>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th class="text-center align-middle">Código</th>
          <th class="text-center align-middle">Descripción</th>
          <th class="text-center align-middle">Estado</th>
          <th class="text-center align-middle"><button type="button" class="btn btn-outline-light my-2" id="btnAdd">Nuevo</button></th>
        </tr>
      </thead>
      <tbody>
        {{foreach items}}
          <tr>
            <td class="text-center align-middle">{{RolId}}</td>
            <td class="text-center align-middle"><a href="index.php?page=admin_rol&mode=DSP&RolId={{RolId}}">{{RolDsc}}</a></td>
            <td class="text-center align-middle">{{RolEst}}</td>
            <td class="text-center align-middle">
              <form action="index.php" method="get">
                  <input type="hidden" name="page" value="admin_rol"/>
                  <input type="hidden" name="mode" value="UPD" />
                  <input type="hidden" name="RolId" value={{RolId}} />
                  <button type="submit" class="btn btn-outline-info my-1">Editar</button>
              </form>
              <form action="index.php" method="get">
                  <input type="hidden" name="page" value="admin_rol"/>
                  <input type="hidden" name="mode" value="DEL" />
                  <input type="hidden" name="RolId" value={{RolId}} />
                  <button type="submit" class="btn btn-outline-danger my-1">Eliminar</button>
              </form>
            </td>
          </tr>
          {{endfor items}}
      </tbody>
    </table>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
     document.getElementById("btnAdd").addEventListener("click", function (e) {
       e.preventDefault();
       e.stopPropagation();
       window.location.assign("index.php?page=admin_rol&mode=INS&RolId=0");
     });
   });
</script>