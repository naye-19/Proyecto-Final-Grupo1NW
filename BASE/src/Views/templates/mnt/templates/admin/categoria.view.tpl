<section class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card my-5 w-100">
      <div class="card-header">
        <h3 class="text-center">{{mode_dsc}}</h3>
      </div>
      <div class="card-body"> 
        <form class="form" method="post" action="index.php?page=admin_categoria&mode={{mode}}&CategoriaId={{CategoriaId}}">
          {{if notDisplayIns}}
          <div class="form-group col-md-2">
            <label for="CategoriaId">Código</label>
            <input type="hidden" class="form-control" id="CategoriaId" name="CategoriaId" value="{{CategoriaId}}"/>
            <input readonly type="text" class="form-control" name="CategoriaIdDummy" value="{{CategoriaId}}"/>
          </div>
          {{endif notDisplayIns}}

          <div class="form-group col-md-10">
            <label for="CategoriaNom">Categoría</label>
            <input type="text" class="form-control" {{readonly}} id="CategoriaNom" name="CategoriaNom" value="{{CategoriaNom}}" maxlength="80" placeholder="Ingrese el nombre de la categoría">
          </div>

          {{if notDisplayIns}}
          <div class="form-group col-md-4">
            <label for="CategoriaEst">Estado</label>
            <br/>
            <select class="form-control" id="CategoriaEst" name="CategoriaEst" {{if readonly}}disabled{{endif readonly}}>
                <option value="ACT" {{CategoriaEst_ACT}}>Activo</option>
                <option value="INA" {{CategoriaEst_INA}}>Inactivo</option>
            </select>
          </div>
          {{endif notDisplayIns}}

          {{if hasErrors}}
          <section>
              <ul>
                {{foreach aErrors}}
                  <li class="text-danger my-2">{{this}}</li>
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
          window.location.assign("index.php?page=admin_categorias");
        });
    });
  </script>
  
  
  
