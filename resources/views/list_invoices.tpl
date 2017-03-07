{extends file="base.tpl"}

{block name="title"}Listado de Comprobantes{/block}

{block name="body"}
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card">
        <div class="card-content">
          <span class="card-title center-align">Listado de Comprobantes</span>
          <table class="bordered highlight centered">
            <thead>
            <tr>
              <th>Id</th>
              <th>Fecha</th>
              <th>Moneda</th>
              <th>Monto</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
              <td>25/02/17</td>
              <td>UYU</td>
              <td>$594.00</td>
            </tr>
            <tr>
              <td>2</td>
              <td>03/09/16</td>
              <td>UYU</td>
              <td>$19323.00</td>
            </tr>
            <tr>
              <td>3</td>
              <td>21/01/17</td>
              <td>USD</td>
              <td>$23.50</td>
            </tr>
            <tr>
              <td>4</td>
              <td>14/01/17</td>
              <td>UYU</td>
              <td>$3194.00</td>
            </tr>
            <tr>
              <td>5</td>
              <td>04/03/17</td>
              <td>ARS</td>
              <td>$12400.00</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
{/block}
