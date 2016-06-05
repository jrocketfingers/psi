# PSI Team Hub

## Preparation
Make sure you create a .env based on .env.example.

## Development
We're using docker, vagrant, and WAMP/LAMP stacks.

If using WAMP/LAMP, you just need to dump it into the public folder.

#### Database preparation
From within a php workspace run `php artisan migrate && php artisan db:seed`

### Docker
Make sure you run `git submodule init` and `git submodule update` to get the laradock repo.
From inside the laradock container run `docker-compose up -d nginx mysql`.

#### Workspace
Use `docker exec -it laradock_workspace_1 bash` to get into the workspace.

### Vagrant
Start the VM with `vagrant up`.
Right after you can access the app at localhost:8000.

When using the PHP artisan, `vagrant ssh` into the box and `cd psi`. Artisan
will have access to the database.

#### Workspace
Use `vagrant ssh && cd psi` to get into the workspace.

## Tech
Since PHP can run on a nearby toaster, we've got three different possible environments.
Hence, the stack tech can differ and this is usable with Apache, Nginx with either mod_php, php-fpm, or such containers.

We're using Laravel with its ORM Eloquent. This allows us to be database agnostic, and the system works with most
standard SQL databases (MySQL tested so far, Azure SQL V12 not yet confirmed).

For notifications we're currently using ajax long polling. Potential alternatives are adding a websocket server like
Centrifugo, Ratchet, or using a third-party push service.

