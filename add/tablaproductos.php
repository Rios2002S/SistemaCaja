<!-- Tabla de productos -->
<div class="table-responsive">    
    <table id="tablaProductos" class="display">
        <thead>
            <tr id="producto<?= $row['id_producto'] ?>">
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad en stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultInventario->fetch_assoc()) { ?>
                <tr id="producto<?= $row['id_producto'] ?>"> <!-- Añadir id único a cada fila -->
                    <td>
                        <?php if ($row['imagen']) { ?>
                            <img src="<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>" style="height: 50px; object-fit: cover;">
                        <?php } else { ?>
                            <img src="https://www.thewall360.com/uploadImages/ExtImages/images1/def-638240706028967470.jpg" alt="Imagen predeterminada" style="height: 50px; object-fit: cover;">
                        <?php } ?>
                    </td>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['descripcion'] ?></td>
                    <td>$<?= number_format($row['precio'], 2) ?></td>
                    <td><?= $row['cantidad_en_stock'] ?></td>
                    <td><?= $row['categoria'] ?: 'Sin categoría' ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalEditarProducto<?= $row['id_producto'] ?>"><i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#modalEliminarProducto<?= $row['id_producto'] ?>"><i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>

                <!-- Modal para editar producto -->
                <div class="modal fade" id="modalEditarProducto<?= $row['id_producto'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="../bd/editar_producto.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_producto" value="<?= $row['id_producto'] ?>">
                                    <div class="mb-3">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" class="form-control" value="<?= $row['nombre'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Descripción</label>
                                        <textarea name="descripcion" class="form-control"><?= $row['descripcion'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Precio</label>
                                        <input type="number" step="0.01" name="precio" class="form-control" value="<?= $row['precio'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Cantidad</label>
                                        <input type="number" name="cantidad_en_stock" class="form-control" value="<?= $row['cantidad_en_stock'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Imagen</label>
                                        <input type="file" name="imagen" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal para eliminar producto -->
                <div class="modal fade" id="modalEliminarProducto<?= $row['id_producto'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="../bd/eliminar_producto.php" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title">Eliminar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_producto" value="<?= $row['id_producto'] ?>">
                                    <p>¿Estás seguro de que deseas eliminar el producto <b><?= $row['nombre'] ?></b>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </tbody>
    </table>
</div>  
<script>
    $(document).ready(function () {
        // Inicializamos la tabla
        var table = $('#tablaProductos').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "lengthMenu": [10, 20, 30, 50],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/Spanish.json"
            }
        });

        // Almacenar la página actual en sessionStorage
        var currentPage = table.page();
        sessionStorage.setItem('currentPage', currentPage);

        // Obtener el fragmento de la URL (por ejemplo, #producto123)
        var hash = window.location.hash;

        // Comprobamos si el hash está presente y es válido
        if (hash.startsWith('#producto')) {
            var id_producto = hash.substring(9); // Obtener solo el ID del producto

            // Buscar la fila en la tabla con el id correspondiente
            var fila = $('#tablaProductos').find('tr#producto' + id_producto);

            // Si encontramos la fila, resaltar la fila y ajustar la página
            if (fila.length) {
                // Resaltar la fila
                fila.css('background-color', '#ffeb3b');

                // Recuperamos la página guardada
                var savedPage = sessionStorage.getItem('currentPage');

                // Verificamos si la página guardada es válida y dentro del rango
                if (savedPage !== null && !isNaN(savedPage)) {
                    var totalPages = table.page.info().pages; // Número total de páginas
                    savedPage = parseInt(savedPage); // Asegurarnos de que sea un número entero

                    if (savedPage >= 0 && savedPage < totalPages) {
                        // Cambiar a la página guardada si es válida
                        table.page(savedPage).draw('page');
                    } else {
                        // Si la página guardada no es válida, cambiar a la primera página
                        table.page(0).draw('page');
                    }
                } else {
                    // Si no hay página guardada, cambiar a la primera página
                    table.page(0).draw('page');
                }

                // Desplazar la página para mostrar la fila
                $('html, body').animate({
                    scrollTop: fila.offset().top - 100
                }, 500);
            }
        }
    });
</script>
