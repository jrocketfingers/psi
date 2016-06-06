# ORM

#### DSL for finite state machine transitions
##### Use case
Handling requests and votes. (states 'unresolved', 'accepted', 'rejected')
##### Known addons
Django: [django-fsm](https://github.com/kmmbvnr/django-fsm)

#### Object level permissions
##### Use case:
Storing default roles in the database as constants.
Team lead is a constant, all the others should be changable through the admin
interface.
##### Known addons
Django: [django-guardian](https://github.com/django-guardian/django-guardian)
