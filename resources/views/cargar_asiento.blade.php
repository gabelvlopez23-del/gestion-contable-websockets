<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carga de Asiento Manual</title>
    <link href="https://jsdelivr.net" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container bg-white p-4 rounded shadow">
        <h2 class="mb-4">📋 Carga de Asiento Manual (Partida Doble)</h2>
        
        <form action="/api/contabilidad/guardar" method="POST">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" required value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-9">
                    <label>Concepto / Glosa</label>
                    <input type="text" name="concepto" class="form-control" placeholder="Ej: Apertura de caja inicial" required>
                </div>
            </div>

            <h5 class="mt-4">Renglones del Asiento</h5>
            <table class="table" id="tabla-renglones">
                <thead>
                    <tr>
                        <th>Cuenta Contable</th>
                        <th style="width: 200px;">Debe (\$)</th>
                        <th style="width: 200px;">Haber (\$)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="lineas[0][plan_cuenta_id]" class="form-control" required>
                                @foreach(\(cuentas as\)c)
                                    <option value="{{ \$c->id }}">{{ \(c->codigo }} - {{\)c->nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="lineas[0][debe]" class="form-control" step="0.01" value="0.00"></td>
                        <td><input type="number" name="lineas[0][haber]" class="form-control" step="0.01" value="0.00"></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-secondary btn-sm" onclick="agregarFila()">+ Agregar Renglón</button>
            <hr>
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-lg">💾 Guardar Asiento en Libro Diario</button>
            </div>
        </form>
    </div>

    <script>
        let contadorFilas = 1;
        function agregarFila() {
            let tabla = document.getElementById('tabla-renglones').getElementsByTagName('tbody')[0];
            let nuevaFila = tabla.rows[0].cloneNode(true);
            
            // Renombrar los índices del formulario para que Laravel los reciba ordenados
            nuevaFila.innerHTML = nuevaFila.innerHTML.replace(/lineas\[0\]/g, `lineas[${contadorFilas}]`);
            tabla.appendChild(nuevaFila);
            contadorFilas++;
        }
    </script>
</body>