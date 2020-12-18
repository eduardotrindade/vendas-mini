<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Finalizar Compra</h1>
      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Produtos</span>
            <span class="badge badge-secondary badge-pill">1</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">10 unidades</h6>
                <small class="text-muted">Compra de Espaços</small>
              </div>
              <span class="text-muted">R$ 120,00</span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>R$ 120,00</strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Comprador</h4>
          <form class="needs-validation" novalidate="">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Nome</label>
                <p>Felipe Martins</p>
              </div>

              <div class="col-md-6 mb-3">
                <label for="email">E-mail</label>
                <p>felipemjesus@gmail.com</p>
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Endereço</label>
              <p>SHN Quadra 2 Bloco A, Sala 1010</p>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Cidade</label>
                <p>Brasília</p>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">Estado</label>
                <p>Distrito Federal</p>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">CEP</label>
                <p>70.702-000</p>
              </div>
            </div>

            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="submit">Realizar pagamento</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
