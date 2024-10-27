<?php

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="module" src="./public/js/dashboard.js"></script>
</head>

<body>
    <main class="flex justify-content-center align-items-center mt-5">
        <div class="w-75 mx-auto">
            <div class="d-flex align-items-center justify-content-between p-3 border rounded">
                <p class="mb-0 fs-2 fw-bolder">Tablero</p>
                <p class="mb-0 fw-medium">
                    <span><?php echo $_SESSION['name'] ?> - </span>
                    <span><?php echo $_SESSION['email'] ?></span>
                </p>
            </div>

            <div class="table-responsive mt-5">
                <div class="d-flex gap-2">
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar...">
                    <button class="btn btn-success btn-sm w-25" id="btn-export-csv">Exportar a CSV</button>
                </div>
                <table class="table table-striped border mt-1">
                    <thead>
                        <tr>
                            <th scope="col" onclick="sortTable(0)">#</th>
                            <th scope="col" onclick="sortTable(1)">Nombre</th>
                            <th scope="col" onclick="sortTable(2)">Teléfono</th>
                            <th scope="col" onclick="sortTable(3)">Correo</th>
                            <th scope="col" onclick="sortTable(4)">RFC</th>
                            <th scope="col" onclick="sortTable(5)">Notas</th>
                            <th scope="col" onclick="sortTable(6)">Creado</th>
                            <th scope="col" onclick="sortTable(7)">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="body-table-users">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 needs-validation" novalidate id="update-register-form">

                            <div class="col-md-6">
                                <label for="name" class="form-label required-input required-input">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required pattern="[A-Za-zÀ-ÿ\s]{2,}">
                                <div class="invalid-feedback">
                                    El nombre es requerido.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label required-input">Teléfono <small
                                        class="text-secondary">(digitos)</small></label>
                                <input type="tel" maxlength="10" class="form-control" name="phone" id="phone" required pattern="\d{10}">
                                <div class="invalid-feedback">
                                    El teléfono es requerido.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label required-input">Correo electrónico</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                                <div class="invalid-feedback">
                                    El correo electrónico es requerido.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="rfc" class="form-label required-input">RFC</label>
                                <input type="text" class="form-control" name="rfc" id="rfc" required
                                    pattern="^([A-Z]{4}[0-9]{6}[A-Z0-9]{3}|[A-Z]{3}[0-9]{6}[A-Z]{1}[A-Z0-9]{2})$">
                                <div class="invalid-feedback">
                                    El RFC no cumple el formato correcto.
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="notes" class="form-label required-input">Notas</label>
                                <textarea class="form-control" rows="5" name="notes" id="notes" placeholder="Escribe tus notas aquí..."
                                    required></textarea>
                                <div class="invalid-feedback">
                                    Es requerimiento brindar notas del registro.
                                </div>
                            </div>

                            <input type="hidden" id="user-id" name="user_id">
                            <div class="col-12">
                                <button class="btn btn-success fw-bolder w-100" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>