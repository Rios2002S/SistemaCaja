<div class="container py-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <!-- Total de Productos -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="../img/productos.png" alt="Icono Total Productos" class="img-fluid mb-2" style="width: 50px;">
                        <h5 class="card-title">Nº de Productos</h5>
                        <p class="display-6"><?= $total_productos ?></p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="../img/ventas.png" alt="Icono Ventas" class="img-fluid mb-2" style="width: 50px;">
                        <h5 class="card-title">Total de Ventas</h5>
                        <p class="display-6"><?= $total_ventas ?></p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                    <img src="../img/usuarios.png" alt="Icono Ventas" class="img-fluid mb-2" style="width: 50px;">
                        <h5 class="card-title">Vendedor #1</h5>
                        <?php while ($usuario = $resultVentasPorUsuario->fetch_assoc()) { ?>
                            <p class="fw-bold">Usuario: <?= $usuario['nombreusu'] ?></p>
                            <p>Total Vendido: $<?= number_format($usuario['total_ventas_usuario'], 2) ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- Producto Más Barato -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Producto Más Barato</h5>
                        <p class="fw-bold"><?= $producto_mas_barato['nombre'] ?></p>
                        <p>Precio: $<?= number_format($producto_mas_barato['precio'], 2) ?></p>
                    </div>
                </div>
            </div>
            
            <!-- Total Dinero Vendido Hoy -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa fa-calendar-day"></i> Vendido (Hoy)</h5>
                        <p class="display-6">
                            <?php if ($total_dinero_vendido_hoy == 0): ?>
                                Ninguna
                            <?php else: ?>
                                $<?= number_format($total_dinero_vendido_hoy, 2) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Total Dinero Vendido Este Mes -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa fa-calendar-alt"></i> Vendido (Este Mes)</h5>
                        <p class="display-6">$<?= number_format($total_dinero_vendido_mes, 2) ?></p>
                    </div>
                </div>
            </div>

            <!-- Total de Dinero Vendido -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa fa-money-bill"></i> Total Dinero Vendido</h5>
                        <p class="display-6">$<?= number_format($total_dinero_vendido, 2) ?></p>
                    </div>
                </div>
            </div>

            <!-- Producto Más Caro -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Producto Más Caro</h5>
                        <p class="fw-bold"><?= $producto_mas_caro['nombre'] ?></p>
                        Precio: $<?= number_format($producto_mas_caro['precio'], 2) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container py-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <!-- Ver Productos -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa fa-cogs"></i>Productos</h5>
                        <!-- Botón para ver todos los productos -->
                        <a href="productos.php" class="btn btn-primary">Ver Productos</a>
                    </div>
                </div>
            </div>

            <!-- Ver Ventas -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title"><i class="fa fa-money-bill"></i>Ventas</h5>
                        <!-- Botón para ver todas las ventas -->
                        <a href="ventas.php" class="btn btn-success">Ver Ventas</a>
                    </div>
                </div>
            </div>

                <?php
                    if ($resultadoVentaMayor->num_rows > 0) {
                        $ventaMayor = $resultadoVentaMayor->fetch_assoc(); // Obtener la fila
                        $fechaVentaMayor = $ventaMayor['fecha_venta'];
                        $totalVentaMayor = $ventaMayor['total'];
                    } else {
                        // Si no hay resultados
                        $fechaVentaMayor = "No disponible";
                        $totalVentaMayor = 0;
                    }
                ?>
        <!-- La mejor venta -->
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger"><i class="fas fa-chart-line"></i> Venta Mayor</h5>
                    <p class="text-primary"><?= $fechaVentaMayor ?><br>
                     $<?= number_format($totalVentaMayor, 2) ?></p>
                </div>
            </div>
        </div>
            <!-- Producto Más Caro -->
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">🛐 Porque nada hay imposible para Dios</h5>
                        <P>Lucas 1:37</P>
                    </div>
                </div>
            </div>

        </div>
    </div>