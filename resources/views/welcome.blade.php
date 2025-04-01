<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Dimensión A</title>

</head>
<body>
    <h2>Formulario - Dimensión A</h2>
    <form>
        <div class="form-group">
            <label for="criterio">Criterio:</label>
            <input type="text" id="criterio" name="criterio" required>
        </div>
        <div class="form-group">
            <label for="indicador">Indicador:</label>
            <input type="text" id="indicador" name="indicador" required>
        </div>
        <div class="form-group">
            <label for="pregunta">Pregunta de apoyo:</label>
            <textarea id="pregunta" name="pregunta"></textarea>
        </div>
        <div class="form-group">
            <label for="responsable">Responsable:</label>
            <input type="text" id="responsable" name="responsable" required>
        </div>
        <div class="form-group">
            <label for="documentos">Documentos a consultar:</label>
            <textarea id="documentos" name="documentos"></textarea>
        </div>
        <div class="form-group">
            <label for="existe">El documento existe:</label>
            <select id="existe" name="existe">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
        <div class="form-group">
            <label for="quien_elabora">Si no existe, ¿Quién debe elaborar?:</label>
            <input type="text" id="quien_elabora" name="quien_elabora">
        </div>
        <div class="form-group">
            <label for="info_complementaria">Documentos e información complementaria:</label>
            <textarea id="info_complementaria" name="info_complementaria"></textarea>
        </div>
        <div class="form-group">
            <label for="respuesta">Desarrollo de la respuesta:</label>
            <textarea id="respuesta" name="respuesta"></textarea>
        </div>
        <div class="form-group">
            <label for="fortalezas">Identificación de fortalezas por criterio:</label>
            <textarea id="fortalezas" name="fortalezas"></textarea>
        </div>
        <div class="form-group">
            <label for="oportunidades">Identificación de áreas de oportunidad/Plan de mejora:</label>
            <textarea id="oportunidades" name="oportunidades"></textarea>
        </div>
        <div class="form-group">
            <label for="evidencias">Evidencias:</label>
            <textarea id="evidencias" name="evidencias"></textarea>
        </div>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>