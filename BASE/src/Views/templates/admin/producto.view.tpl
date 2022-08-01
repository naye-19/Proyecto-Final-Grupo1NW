<section class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card my-5 w-100">
        <div class="card-header">
            <h3 class="text-center">{{mode_dsc}}</h3>
        </div>
        <div class="card-body"> 
            <form class="form" method="post" action="index.php?page=admin_producto&mode={{mode}}&ProdId={{ProdId}}" enctype="multipart/form-data">
                {{if notDisplayIns}}
                <div class="form-group col-md-2">
                    <label for="ProdId">Código</label>
                    <input type="hidden" class="form-control" id="ProdId" name="ProdId" value="{{ProdId}}"/>
                    <input readonly type="text" class="form-control" name="CategoriaIdDummy" value="{{ProdId}}"/>
                </div>
                {{endif notDisplayIns}}

            <div class="form-group col-md-10">
                <label for="ProdNombre">Producto</label>
                <input type="text" class="form-control" {{readonly}} id="ProdNombre" name="ProdNombre" value="{{ProdNombre}}" maxlength="60" placeholder="Ingrese el nombre del producto" required>
            </div>

            <div class="form-group col-md-10">
                <label for="ProdDescripcion">Descripción</label>
                <textarea type="text" class="form-control" {{readonly}} id="ProdDescripcion" name="ProdDescripcion" maxlength="500" placeholder="Ingrese la Descripción del producto">{{ProdDescripcion}}</textarea>
            </div>
          
            <div class="row ml-0">
                <div class="form-group col-sm-4">
                    <label for="ProdPrecioVenta">Precio de Venta</label>
                    <input type="number" class="form-control" {{readonly}} id="ProdPrecioVenta" name="ProdPrecioVenta" value="{{ProdPrecioVenta}}" maxlength="11" placeholder="0" required>
                </div>

                <div class="form-group col-sm-4">
                    <label for="ProdPrecioCompra">Precio de Compra</label>
                    <input type="number" class="form-control" {{readonly}} id="ProdPrecioCompra" name="ProdPrecioCompra" value="{{ProdPrecioCompra}}" maxlength="11" placeholder="0" required>
                </div>
            </div>

            <div class="row ml-0">
                <div class="form-group col-md-4">
                    <label for="ProdEst">Estado</label>
                    <br/>
                    <select class="form-control" id="ProdEst" name="ProdEst" {{if readonly}}disabled{{endif readonly}}>
                        <option value="ACT" {{ProdEst_ACT}}>Activo</option>
                        <option value="INA" {{ProdEst_INA}}>Inactivo</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="ProdStock">Stock</label>
                    <input type="number" class="form-control" {{readonly}} id="ProdStock" name="ProdStock" value="{{ProdStock}}" maxlength="11" placeholder="Ingrese la cantidad del producto" required>
                </div>
            </div>

            <div class="form-group col">
                <label class="row ml-0">Imagen</label>
                <div class="row">
                    {{foreach Media}}
                    <div class="col-sm-6 col-md-4">
                        <img src="{{MediaPath}}" alt="" width="150px">
                        <input type="hidden" class="form-control" id="MediaDoc" name="MediaDoc" value="{{MediaDoc}}"/>
                        <input type="hidden" class="form-control" id="MediaId" name="MediaId" value="{{MediaId}}"/>
                    </div>
                    {{endfor Media}}
                </div>
                {{if notDisplayDel}}
                <input type="file" class="mt-2" id="imagenes[]" name="imagenes[]" multiple>
                {{endif notDisplayDel}}
            </div>
            {{if hasErrors}}
            <section>
            <ul>
                {{foreach aErrors}}
                    <li>{{this}}</li>
                {{endfor aErrors}}
            </ul>
            </section>
            {{endif hasErrors}}

          <button type="button" class="btn btn-warning mt-2 ml-3 mr-2" id="btnCancelar" name="btnCancelar">Cancelar</button>
          {{if showaction}}
            <button type="submit" class="btn btn-primary mt-2 mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
          {{endif showaction}}
        </form>
      </div>
    </div>
  </section>
  
  <script>
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById("btnCancelar").addEventListener("click", function(e){
          e.preventDefault();
          e.stopPropagation();
          window.location.assign("index.php?page=admin_productos");
        });
    });
  </script>