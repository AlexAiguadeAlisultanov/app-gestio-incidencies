# Poner esto en internet

El `Dockerfile` levanta PHP 8.2 con Apache, instala las dependencias de Composer
y lanza las migraciones al arrancar, así que la base de datos se prepara sola.

Los estilos compilados están versionados en `public/build`, de modo que el
contenedor no necesita Node ni ejecutar `npm run build`.


## El botón

[![Deploy to Render](https://render.com/images/deploy-to-render-button.svg)](https://render.com/deploy?repo=https://github.com/AlexAiguadeAlisultanov/app-gestio-incidencies)

Al pulsarlo, Render lee el `render.yaml` de este repositorio, crea el servicio
con la configuración ya puesta y solo te pide los valores de las variables. Hace
falta una cuenta de Render, que se crea entrando con GitHub y es gratis.

Los pasos de abajo son lo mismo a mano, por si prefieres verlo.

## En Render

1. New → Web Service, y conecta este repositorio.
2. Runtime: **Docker**.
3. Instance Type: **Free**.
4. Añade las variables de abajo en Environment.

## Variables que hay que definir

| Variable | Qué es |
|---|---|
| `APP_KEY` | Genérala con `php artisan key:generate --show` y pega el resultado entero, `base64:` incluido |
| `APP_URL` | La dirección pública, por ejemplo `https://incidencias.onrender.com` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false`. En `true` enseñaría las trazas de error a cualquiera |
| `DB_CONNECTION` | `mysql` |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | La base de datos |

`PORT` la pone el hosting; no la definas tú.

**La `APP_KEY` que estuvo en el historial de este repositorio está publicada.**
Genera una nueva; no reutilices aquella.

## Después del primer arranque

Las migraciones crean las tablas, pero la base queda vacía y no habrá con qué
entrar. Importa `db/datos-ejemplo.sql`, que crea dos usuarios (contraseña
`prova1234`), cuatro categorías y seis incidencias.

## Aviso sobre las capas gratuitas

En el plan gratuito de Render el servicio se duerme a los 15 minutos sin visitas.
La siguiente carga tarda alrededor de un minuto mientras arranca otra vez.
