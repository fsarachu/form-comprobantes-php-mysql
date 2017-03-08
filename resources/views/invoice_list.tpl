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
              <th>Monto</th>
              <th>Imagen</th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$invoices item=invoice}
              <tr>
                <td>{$invoice->getId()}</td>
                <td>{$invoice->getInvoiceDate()}</td>
                <td>({$invoice->getCurrencyObj()->getCode()}) {$invoice->getCurrencyObj()->getSymbol()} {$invoice->getAmount()}</td>
                {if $invoice->getImage() != ""}
                  <td><a target="_blank" href="{$BASE_URL nofilter}{$invoice->getImage() nofilter}">Ver</a></td>
                {else}
                  <td>-</td>
                {/if}
              </tr>
            {/foreach}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
{/block}
