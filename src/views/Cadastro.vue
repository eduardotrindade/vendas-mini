<template>
  <div>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Cadastro de Afiliado</h1>
      <p class="lead">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 px-5">
          <form class="needs-validation" novalidate="">
            <div class="row">
              <div class="col-md-6">
                <h4 class="mb-3">Dados Pessoais</h4>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label for="firstName">Nome</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label for="lastName">CPF/CNPJ</label>
                    <the-mask :mask="['###.###.###-##', '##.###.###/####-##']" class="form-control" autocomplete="off" placeholder="" id="cpf_cnpj" name="cpf_cnpj" />
                    <div class="invalid-feedback">
                      Valid last name is required.
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label for="phone">Celular <span class="text-muted">(com WhatsApp)</span></label>
                    <the-mask :mask="['(##) ####-####', '(##) #####-####']" class="form-control" placeholder="" id="phone" name="phone" />
                    <div class="invalid-feedback">
                      Valid last name is required.
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" placeholder="">
                    <div class="invalid-feedback">
                      Please enter a valid email address for shipping updates.
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="email-confirme">Confirme o e-mail</label>
                    <input type="email" class="form-control" id="email-confirme" placeholder="">
                    <div class="invalid-feedback">
                      Please enter a valid email address for shipping updates.
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <h4 class="mb-3">Dados de Endereço</h4>
                <div class="mb-3">
                  <label for="address">Logradouro</label>
                  <input type="text" class="form-control" id="address" placeholder="" required="">
                  <div class="invalid-feedback">
                    Please enter your shipping address.
                  </div>
                </div>

                <div class="mb-3">
                  <label for="address2">Complemento <span class="text-muted">(Optional)</span></label>
                  <input type="text" class="form-control" id="address2" placeholder="">
                </div>

                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="state">Estado</label>
                    <select class="custom-select d-block w-100" id="state" required="">
                      <option value="">Selecione</option>
                      <option>Distrito Federal</option>
                    </select>
                    <div class="invalid-feedback">
                      Please provide a valid state.
                    </div>
                  </div>
                  <div class="col-md-5 mb-3">
                    <label for="country">Cidade</label>
                    <select class="custom-select d-block w-100" id="country" required="">
                      <option value="">Selecione</option>
                      <option>Brasília</option>
                    </select>
                    <div class="invalid-feedback">
                      Please select a valid country.
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="zip">CEP</label>
                    <input type="text" class="form-control" id="zip" placeholder="" required="">
                    <div class="invalid-feedback">
                      Zip code required.
                    </div>
                  </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="save-info">
                  <label class="custom-control-label" for="save-info">Eu li e concordo com os termos de uso e privacidade.</label>
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Solicitar cadastro</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mask} from 'vue-the-mask'

export default {
  directives: {mask}
}
</script>
