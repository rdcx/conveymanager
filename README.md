![Welcome Page](screenshots/01-welcome.png)

## ConveyManager

Welcome to the Conveyancing Manager, a demonstration of a modern web application built with Laravel 11 and Inertia.js + VueJS 3. This project showcases several core features and best practices discussed in prior sessions.



Below, you'll find screenshots highlighting various functionalities of the application, along with links to the relevant code files.


### Installation with docker

```
git clone git@github.com:rdcx/conveymanager.git; cd conveymanager/

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs;

vendor/bin/sail up -d
```

### Tests

There are a few Pest tests included in the example.

- `tests/Feature/ProcessAMLChecksTest.php`

### Notable areas of development

- `routes/web.php`
- `app/Policies`
- `app/Jobs`
- `app/Listeners`
- `app/Http/Controllers`
- `app/Http/Requests`

## Jobs, Listeners & Notifications

This application includes several jobs, listeners, and notifications to handle background processing efficiently. Below is a snapshot of the job queue in action.

![Job Queue](screenshots/07-jobs-queue.png)

**Related Code Files:**
- `app/Listeners/DispatchAMLChecks.php`
- `app/Jobs/PerformAMLChecks.php` 
- `app/Jobs/ProcessAMLResults.php`
- `app/Notifications/AMLChecksCompleteNotification.php`

## Add Clients

This section allows users to add new clients to the system.

![Add Clients](screenshots/02-add-clients.png)

**Related Code Files:**
- `resources/js/Pages/Clients/Create.vue`
- `app/Http/Controllers/ClientController.php`

## Create Property

Conveyancers / Admins can create new properties.

![Create Property](screenshots/03-create-property.png)

**Related Code Files:**
- `resources/js/Pages/Property/Create.vue`
- `app/Http/Controllers/PropertyController.php`

## Open Cases

Open cases within a property.

![Open Cases](screenshots/04-open-cases.png)

**Related Code Files:**
- `resources/js/Pages/ConveyancingCase/Create.vue`
- `app/Http/Controllers/CaseController.php`

## Show Property Cases

Users can navigate through different cases to view details or make updates.

![Navigate Cases](screenshots/05-navigate-cases.png)

**Related Code Files:**
- `resources/js/Pages/Property/Show.vue`
- `app/Http/Controllers/CaseController.php`

## Update Cases and Tasks

This feature allows users to update tasks related to a specific case.

![Update Tasks](screenshots/06-update-tasks.png)

**Related Code Files:**
- `resources/js/Pages/ConveyancingCase/Edit.vue` 
- `app/Http/Controllers/TaskController.php`

