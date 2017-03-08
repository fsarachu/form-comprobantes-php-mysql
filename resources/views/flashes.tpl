{if !empty($flashes)}
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      {if isset($flashes['success'])}
        {foreach from=$flashes['success'] item=msg}
          <div class="alert alert-success">
            {$msg}
          </div>
        {/foreach}
      {/if}
      {if isset($flashes['info'])}
        {foreach from=$flashes['info'] item=msg}
          <div class="alert alert-info">
            {$msg}
          </div>
        {/foreach}
      {/if}
      {if isset($flashes['warning'])}
        {foreach from=$flashes['warning'] item=msg}
          <div class="alert alert-warning">
            {$msg}
          </div>
        {/foreach}
      {/if}
      {if isset($flashes['error'])}
        {foreach from=$flashes['error'] item=msg}
          <div class="alert alert-danger">
            {$msg}
          </div>
        {/foreach}
      {/if}
    </div>
  </div>
{/if}
