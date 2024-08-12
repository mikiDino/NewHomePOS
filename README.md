# Instalación de Home en POS
![Previsualización](previsualizacion.png)

## Pasos de instalación

1. **Reemplazar el archivo `index.blade.php`:**
   - Reemplaza el archivo `index.blade.php` en la ruta `resources/views/home`.

2. **Agregar la carpeta `svg`:**
   - Copia y agrega la carpeta `svg` en la ruta `resources/views/home`.

3. **Modificar `app.blade.php`:**
   - Abre el archivo `resources/views/layouts/app.blade.php`.
   - En la línea 51, agrega el siguiente código:
     ```php
     @if (!$pos_layout && $request->segment(1) !== 'home')
     ```

4. **Modificar el `HomeController`:**
   - Abre el archivo `app/Http/Controllers/HomeController.php`.
   - En la línea 211, agrega el siguiente código:
     ```php
     $logo = request()->session()->get('business.logo');
     $wh = isMobile() ? 50 : 150;
     ```
   - Asegúrate de retornar la variable `$logo` y `$wh` que generalizara el tamanio de los svgs al blade.

## Notas adicionales
- Asegúrate de seguir estos pasos en el orden correcto para evitar errores en la implementación.
- Verifica que todos los cambios se reflejen correctamente en la interfaz de usuario después de completar estos pasos.
