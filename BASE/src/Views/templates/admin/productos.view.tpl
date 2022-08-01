<section class="container-fluid min-vh-100">

    <h3 class="my-4 text-center">Gestión de Productos</h3>

    <div class="d-flex-inline">
        <form method="POST" action="index.php?page=admin_productos">
        <div class="form-row">
            <div class="col-8">
            <input type="search" class="form-control" id="ProductoBusqueda" name="ProductoBusqueda" value="{{ProductoBusqueda}}" placeholder="Ingrese su busqueda">
            </div>
            <div class="col-2">
            <button type="submit" class="btn btn-primary mb-2" id="btnBuscar" name="btnBuscar">Buscar</button>
            </div>
        </div>
        </form> 
    </div>

    <div class="table-responsive">
        <table class="table">
        <thead class="thead-light">
            <tr>
            <th class="text-center align-middle">Código</th>
            <th class="text-center align-middle">Producto</th>
            <th class="text-center align-middle">Descripción</th>
            <th class="text-center align-middle">Precio Venta</th>
            <th class="text-center align-middle">Precio Compra</th>
            <th class="text-center align-middle">Estado</th>
            <th class="text-center align-middle">Stock</th>
            <th class="text-center align-middle"><button type="button" class="btn btn-primary my-2" id="btnAdd">Nuevo</button></th>
            </tr>
        </thead>
        <tbody>
            {{foreach items}}
            <tr>
                <td class="text-center align-middle">{{ProdId}}</td>
                <td class="text-center align-middle"><a href="index.php?page=admin_producto&mode=DSP&ProdId={{ProdId}}">{{ProdNombre}}</a></td>
                <td class="text-center align-middle">{{ProdDescripcion}}</td>
                <td class="text-center align-middle">{{ProdPrecioVenta}}</td>
                <td class="text-center align-middle">{{ProdPrecioCompra}}</td>
                <td class="text-center align-middle">{{ProdEst}}</td>
                <td class="text-center align-middle">{{ProdStock}}</td>
                <td class="text-center align-middle">
                <form action="index.php" method="get">
                    <input type="hidden" name="page" value="admin_producto"/>
                    <input type="hidden" name="mode" value="UPD" />
                    <input type="hidden" name="ProdId" value={{ProdId}} />
                    <button type="submit" class="btn btn-primary my-1">Editar</button>
                </form>
                <form action="index.php" method="get">
                    <input type="hidden" name="page" value="admin_producto"/>
                    <input type="hidden" name="mode" value="DEL" />
                    <input type="hidden" name="ProdId" value={{ProdId}} />
                    <button type="submit" class="btn btn-danger my-1">Eliminar</button>
                </form>
                </td>
            </tr>
            {{endfor items}}
        </tbody>
      </table>
    </div>
  </section>
  <script>
    document.addEventListener("DOMContentLoaded", function () 
    {
        document.getElementById("btnAdd").addEventListener("click", function (e){
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=admin_producto&mode=INS&ProdId=0");
        });
     });
  </script>
