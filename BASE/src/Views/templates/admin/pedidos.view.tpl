<section class="container-fluid min-vh-100">

    <h3 class="my-4 text-center">Gestión de Pedidos Pendientes</h3>

    <div class="d-flex-inline">
        <form method="POST" action="index.php?page=admin_pedidos">
        <div class="form-row">
            <div class="col-8">
            <input type="search" class="form-control" id="UsuarioBusqueda" name="UsuarioBusqueda" value="{{UsuarioBusqueda}}" placeholder="Ingrese su busqueda">
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
            <th class="text-center align-middle">Fecha</th>
            <th class="text-center align-middle">ISV</th>
            <th class="text-center align-middle">Estado</th>
            <th class="text-center align-middle">Nombre del Cliente</th>
            <th class="text-center align-middle">Dirección del Cliente</th>
            <th class="text-center align-middle">Teléfono del Cliente</th>
            <th class="text-center align-middle">Link para Devolución</th>
            <th class="text-center align-middle">Link para Orden en Paypal</th>
            <th class="text-center align-middle">Ganancia Bruta</th>
            <th class="text-center align-middle">Comisión de Paypal</th>
            <th class="text-center align-middle">Ganancia Neta</th>
            <th class="text-center align-middle"></th>
            </tr>
        </thead>
        <tbody>
            {{foreach items}}
            <tr>
                <td class="text-center align-middle"><a href="index.php?page=admin_pedido&mode=DSP&VentaId={{VentaId}}">{{VentaId}}</a></td>
                <td class="text-center align-middle">{{VentaFecha}}</td>
                <td class="text-center align-middle">{{VentaISV}}</td>
                <td class="text-center align-middle">{{VentaEst}}</td>
                <td class="text-center align-middle">{{UsuarioNombre}}</td>
                <td class="text-center align-middle">{{ClienteDireccion}}</td>
                <td class="text-center align-middle">{{ClienteTelefono}}</td>
                <td class="text-center align-middle"><a href="{{VentaLinkDevolucion}}">{{VentaLinkDevolucion}}</a></td>
                <td class="text-center align-middle"><a href="{{VentaLinkOrden}}">{{VentaLinkOrden}}</a></td>
                <td class="text-center align-middle">{{VentaCantidadTotal}}</td>
                <td class="text-center align-middle">{{VentaComisionPayPal}}</td>
                <td class="text-center align-middle">{{VentaCantidadNeta}}</td>
                <td class="text-center align-middle">
                <form action="index.php" method="get">
                    <input type="hidden" name="page" value="admin_pedido"/>
                    <input type="hidden" name="mode" value="UPD" />
                    <input type="hidden" name="VentaId" value={{VentaId}} />
                    <button type="submit" class="btn btn-primary my-1">Cambiar Estado</button>
                </form>
                </td>
            </tr>
            {{endfor items}}
        </tbody>
      </table>
    </div>
  </section>
