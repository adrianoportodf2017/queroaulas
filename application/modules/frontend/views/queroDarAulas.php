<style>
  .fundo {
    background-image: url("<?php echo base_url() ?>uploads/fundohome.svg");
    height: 500px;
    width: 100%;
    background-position: right;
    background-repeat: no-repeat;
    background-size: contain;
    position: relative;
  }
</style>
<main class="main-content  mt-10">
  <div class="container-fluid py-4  ">

    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center ">
      <div class="col-xl-4 col-lg-4 col-md-4 mx-auto">
        <div class="">
          <div class="">
            <h5 style="color: white; text-align: justify;">Faça parte da maior comunidade de professores do Brasil
              Conheça os benefícios de fazer parte da rede Quero Aulas</h5>
          </div>
          <h6 style="color: white; text-align: justify; font-weight: 300;"> Línguas, Reforço Escolar, Esportes, Música, Artes e Lazer.
            Professores, estudantes, autodidatas, apaixonados, graduados, profissionais
          </h6>
          <img class="hero-image" src="<?php echo base_url() ?>uploads/cadastro.svg" alt="Plataforma de Estudos">


        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4 mx-auto ">
        <div class="card z-index-0">
          <div class="card-header text-center pt-4">
            <h5>Faça parte</h5>
          </div>
          <div class="row px-xl-5 px-sm-4 px-3">
          </div>
          <div class="card-body">
            <form method="post" id="myform" action="<?php echo site_url('frontend/salvar_profissional/'); ?>" name="myform" onSubmit="return false">
              <div class="row">
               
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="text" placeholder="Nome Completo" class="form-control required w3-round" required name="first_name" id="name" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">

                    <input type="email" class="form-control required w3-round email" required id="email" name="email" placeholder="email">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input class="form-control required min" type="password" required id="password" name="password" placeholder="Senha" min="3">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group has-success">
                    <input type="text" placeholder="Celular" id="phone" name="phone" class="form-control required w3-round phone" required />
                  </div>
               </div>          
             <div class="form-check">
                  <label class="" for="customCheck1">Li e concordo com os Termos e Condições e Política de Privacidade</label>
                  <input class="form-check-input required " require type="checkbox" value="1" id="fcustomCheck1" checked="" name="terms">
                </div>
                <button class="btn btn-outline-primary btn-block mt-0" id="btn_bt_loader" onclick="validate()">Finalizar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</main>
<!-- JavaScript (jQuery) libraries, plugins and custom scripts-->