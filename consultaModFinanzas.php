<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  include "../models/m_finanzas.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Finanzas</title>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>
    <link rel="stylesheet" href="styles.css">
    <script src="./mostrarSeccion.js" defer></script>
    <script src="ojo.js"></script>
  </head>
  <body>
    <!-- Header -->
    <?php
    include "header.php";
    ?>
    <!-- ./Header -->

   
    <main class="flex w-full">
       <!-- Sidebar -->
      <?php include "menu.php";?>
      <!-- section -->
      <section class="w-full overflow-y-auto" style="height: 90vh">
        <header class="flex p-5 gap-5">
          <button
            id="btn-user"
            class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="window.location.href='finanzas.php?section=finanzas'"
          >
            Volver
          </button>
        </header>
        <article class="w-full p-5">
            <?php
              $instancia = new finanza();
              $respuesta = $instancia->ConsultaEspecifica($_GET);
            ?>
          <!-- registro -->
          <section class="w-full h-full justify-center items-center flex flex-col" id="registerAnimal">
            <h2 class="text-3xl font-semibold">Modificar Finanzas</h2>
            <form action="../controllers/finanza/modificacion.php" method="POST" class="w-1/2" enctype="multipart/form-data">
            <div class="mb-5 hidden">
                <label
                  for="id_transaccion"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Id Trasnsaccion:
                </label>
                <input
                  type="number"
                  name="id_transaccion"
                  id="id_transaccion"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                  value = "<?php echo $respuesta[0]['id_transaccion'] ?>"
                />
              </div>
            
            <div class="mb-5">
                <label
                  for="tipo"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Tipo de transaccion:
                </label>
                <select
                  name="tipo"
                  id="tipo"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                >
                <option value = "<?php echo $respuesta[0]['tipo'] ?>"><?php echo $respuesta[0]['tipo'] ?></option>
                <option value="1">Ingreso</option>
                <option value="2">Egreso</option>
              </select>
              </div>

            <div class="mb-5">
                <label
                  for="monto"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Monto:
                </label>
                <input
                  type="number"
                  name="monto"
                  id="monto"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                  value = "<?php echo $respuesta[0]['monto'] ?>"
                />
              </div>

              <div class="mb-5">
                <label
                  for="descripcion"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  descripcion:
                </label>
                <input
                  type="text"
                  name="descripcion"
                  id="descripcion"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                  value = "<?php echo $respuesta[0]['descripcion'] ?>"
                />
              </div>
              <button
              class="hover:shadow-form rounded-md bg-lime-500 py-3 px-8 text-base font-semibold text-white outline-none"
                >
                  Modificar
                </button>
              </div>
            </form>
          </section>
        </article>
      </section>
    </main>
    <?php
      include "footer.php";
    ?>
  </body>
</html>