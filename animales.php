<?php
  session_start();
  if(empty($_SESSION)){
    header("Location: login.php");
  }

  include "../models/m_animal.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AgroSys | Animales</title>
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
    <link
      rel="shortcut icon"
      href="/interfaces/IMG/logo.Jpg"
      type="image/x-icon"
    />
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
            class="bg-green-500 duration-150 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="mostrarSeccion('registerAnimal')"
          >
            <ion-icon name="add-outline"></ion-icon>
            Registrar Animal
          </button>
          <button
            id="btn-user"
            class="bg-blue-300 duration-150 hover:!border-b-2 text-blue-950 rounded-xl drop-shadow-lg group flex items-center border-2 border-b-4 border-blue-950 cursor-pointer p-3 font-semibold hover:bg-yellow-400x"
            onclick="mostrarSeccion('consultaAnimal')"
          >
            Consultar Animales
          </button>
        </header>
        <article class="w-full p-5">
          <!-- consulta -->
          <section class="w-full activesection seccion justify-center gap-10 items-center flex-wrap" id="consultaAnimal">
            <?php
              $instancia = new animal();
              $respuesta = $instancia->consultaGeneral();
              foreach($respuesta as $valor){
              $imagenA = base64_encode($valor['foto']);
            ?>
              <div
            class="bg-white flex flex-col mt-6 text-gray-700 shadow-md bg-clip-border rounded-xl w-96"
          >
            <div
              class="h-56 mx-4 -mt-6 overflow-hidden text-white shadow-lg bg-clip-border rounded-xl bg-blue-gray-500 shadow-blue-gray-500/40"
            >
              <img
                src="data:image/jpeg;base64,<?php echo $imagenA ?>"
                alt="foto animal"
              />
            </div>
            <div class="p-6">
              <h5
                class="mb-2 font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900 text-center"
              >
                <?php echo $valor['nombre'] ?>
              </h5>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Id: </b> <?php echo $valor['id_animal'] ?>
              </p>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Nombre: </b> <?php echo $valor['nombre'] ?>
              </p>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Especie: </b> <?php echo $valor['especie'] ?>
              </p>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Peso: </b> <?php echo $valor['peso']." KG" ?>
              </p>
              <p
                class="block font-sans text-base antialiased font-light leading-relaxed text-inherit"
              >
                <b>Registrado por: </b> <?php echo $valor['nombre_user']." ".$valor['apellido_user'] ?>
              </p>
            </div>
            <div class="p-6 pt-0 flex justify-end gap-5">
              <a href="consultaModAnimal.php?section=animales&&id_animal=<?php echo $valor['id_animal']; ?>" class="text-2xl text-yellow-500">
                <ion-icon name="create-outline"></ion-icon>                
              </a>
              <a href="animales.php?section=animales&&id=<?php echo $valor['id_animal'] ?>">
                <ion-icon name="trash-outline" class="text-2xl text-red-500"></ion-icon>
              </a>
            </div>
          </div>
            <?php
              }
            ?>


          </section>
          <!-- registro -->
          <section class="w-full h-full justify-center items-center seccion flex-col" id="registerAnimal">
            <h2 class="text-3xl font-semibold">Registrar Animal</h2>
            <form action="../controllers/animal/registro.php" method="POST" class="w-1/2" enctype="multipart/form-data">
              <div class="mb-5">
                <label
                  for="nombre"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Nombre:
                </label>
                <input
                  type="text"
                  name="nombre"
                  id="nombre"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                />
              </div>
              <div class="mb-5">
                <label
                  for="especie"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Especie:
                </label>
                <select
                  name="especie"
                  id="especie"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                >
                  <option value="" selected>-</option>
                  <option value="1">Vaca</option>
                  <option value="2">Cerdo</option>
                  <option value="3">Gallina</option>
                  <option value="4">Caballo</option>
                  <option value="5">Oveja</option>
                  <option value="6">Pato</option>
                  <option value="7">Conejo</option>
                  <option value="8">Perro</option>
              </select>
              </div>
              <div class="mb-5">
                <label
                  for="peso"
                  class="mb-3 block text-base font-medium text-[#07074D]"
                >
                  Peso(Kg):
                </label>
                <input
                  type="number"
                  name="peso"
                  id="peso"
                  class="w-full rounded-md border border-slate-300 bg-white py-3 px-6 text-base font-medium outline-none focus:border-lime-600 focus:shadow-md"
                  required
                />
              </div>
              <p class="mb-3 block text-base font-medium text-[#07074D]">Foto:</p>
              <div class="image-container flex justify-center items-center rounded-md border border-slate-300 w-full focus:outline-none focus:border-blue-400">
                <label>
                    <img class="profile-image object-cover" src="../images/siluetaAnimal.jpg" alt="Imagen de animal" id="preview-image" style="width:30%;position:relative;left:35%">
                    <div class="camera-icon">
                        <ion-icon name="camera"></ion-icon>
                    </div>
                    <input type="file" class="hidden" id="file-input" name="foto" id="fotoP" accept="image/*" onchange="mostrarImagenPreview(event)">
                </label>
              </div>
              <script>
                  function mostrarImagenPreview(event) {
                      const input = event.target;
                      const reader = new FileReader();

                      reader.onload = function () {
                          const preview = document.getElementById('preview-image');
                          preview.src = reader.result;
                      };

                      if (input.files && input.files[0]) {
                          reader.readAsDataURL(input.files[0]);
                      }
                  }
              </script>
              <div class="w-full flex justify-center mt-5">
                <button
                  class="hover:shadow-form rounded-md bg-lime-500 py-3 px-8 text-base font-semibold text-white outline-none"
                >
                  Registrar
                </button>
              </div>
            </form>
          </section>
        </article>
        <!-- modal eliminar -->
        <?php if(isset($_GET['id'])){ ?>
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
          <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
              <h2 class="text-3xl font-semibold mb-4 text-center">¿Estas seguro de eliminar este animal?</h2>
              <div class="flex justify-evenly">
              <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75" onclick="window.location.href='animales.php?section=animales'">Cancelar</button>
              <form action="../controllers/animal/eliminar.php" method="post">
                <input type="hidden" name="id_animal" value="<?php echo $_GET['id'] ?>">
                <button class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">Eliminar</button>
              </form>
              </div>
          </div>
        </div>
        <?php } ?>
      </section>
    </main>
    <?php
      include "footer.php";
    ?>
  </body>
</html>
