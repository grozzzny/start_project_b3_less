My default proect for Yii2. Usuario and Admin panel
==============================

### Install project
```
composer create-project --prefer-dist --stability=dev grozzzny/start_project_b3_less www dev-master
```

### Run migrations
```
php yii migrate
```

### Create user
```
yii user/create <email> <username> [password] [administrator]
```

### Admin panel and settings user
```
https://my-site.com/user/admin
https://my-site.com/admin
```

#### Modules, components and widgets
- User module. [Usuario](https://yii2-usuario.readthedocs.io/en/latest/) 
- Admin panel. [Dashboard](https://github.com/grozzzny/admin) 
- Assets. [Depends](https://github.com/grozzzny/depends) 
