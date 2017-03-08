<!doctype html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{block name="title"}Comprobantes de Pago{/block}</title>

  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="/css/vendor.css">
  <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<nav class="row">
  <div class="col s12 m8 offset-m2 l6 offset-l3">
    <ul class="tabs">
      <li class="tab col s6">
        <a {if $CURRENT_URL == "/invoice/new"}class="active"{/if} target="_self" href="/invoice/new">Nuevo</a>
      </li>
      <li class="tab col s6">
        <a {if $CURRENT_URL == "/invoice/all"}class="active"{/if} target="_self" href="/invoice/all">Listar</a>
      </li>
    </ul>
  </div>
</nav>

{include file="flashes.tpl"}

{block name="body"}{/block}

<script src="/js/vendor.js"></script>
<script src="/js/main.js"></script>
</body>
</html>
