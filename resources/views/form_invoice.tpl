{extends file="base.tpl"}

{block name="title"}Cargar Comprobante{/block}

{block name="body"}
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card comprobante-card">
        <div class="card-content">
          <h1>Comprobante de Pago</h1>
          <form action="/invoice/new" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="input-field col s6">
                <input name="invoice_date" type="date" class="datepicker" id="invoice_date">
                <label class="active" for="invoice_date">Fecha</label>
              </div>
              <div class="input-field col s6">
                <select name="payment_method" id="payment_method">
                  {foreach item=method from=$payment_methods}
                    <option value="{$method->getId()}"
                      {if $default_payment_method == $method->getId()}
                    selected
                      {/if}>{$method->getName()}
                    </option>
                  {/foreach}
                </select>
                <label for="payment_method">Método de pago</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
                <select name="currency" id="currency">
                  {foreach item=currency from=$currencies}
                    <option value="{$currency->getId()}"
                      {if $default_currency == $currency->getId()}
                    selected
                      {/if}>{$currency->getCode()} ({$currency->getSymbol()})
                    </option>
                  {/foreach}
                </select>
                <label for="currency">Moneda</label>
              </div>
              <div class="input-field col s6">
                <input name="amount" type="number" step="0.01" min="0.00" placeholder="0.00" id="amount">
                <label for="amount">Monto</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <textarea name="description" class="materialize-textarea" placeholder="" id="description"></textarea>
                <label for="description">Descripción</label>
              </div>
            </div>
            <div class="row">
              <div class="file-field input-field col s12">
                <h3>Foto del comprobante</h3>
                <div class="btn-flat">
                  <span>Seleccionar</span>
                  <input name="image" type="file">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text">
                </div>
              </div>
            </div>
            <div class="row">
              <p class="col s12">
                <input name="signed_by_business" value="true" type="checkbox" class="filled-in"
                       id="signed_by_business"/>
                <label for="signed_by_business">A nombre de la empresa</label>
              </p>
            </div>
            <div class="row">
              <div class="col s12">
                <button class="btn-large waves-effect waves-lighter full-width" type="submit">Cargar comprobante
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
{/block}
